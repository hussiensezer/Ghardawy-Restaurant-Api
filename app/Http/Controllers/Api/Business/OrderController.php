<?php

namespace App\Http\Controllers\Api\Business;

use App\Http\Controllers\Controller;
use App\Models\Caption;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use GeneralTrait, LanguageTrait;

    public function index(Request $request)
    {

        $orders = Order::select(['id', 'status', 'total_price', 'created_at', 'customer_id', 'caption_id'])
            ->where('place_id', auth('api-owner')->user()->place->id)
            ->with([
                'customerId' => function ($q) {
                    $q->select(['id', 'name', 'phone']);
                },

                'captionId' => function ($q) {
                    $q->select(['id', 'name', 'phone']);
                }
            ])->get();

       if(!$orders) {

       }
    }// End Index Get All Orders

    public function orderDetails(Request $request, $id)
    {
        $itemName = $this->LanguageData('language', 'name', 'itemName', $request);
        $sizeName = $this->LanguageData('language', 'name', 'sizeName', $request);
        $addOnName = $this->LanguageData('language', 'name', 'addOnName', $request);
        $order = Order::select(['id', 'customer_id', 'caption_id', 'status', 'tax', 'fees', 'delivered_fees', 'total_price', 'created_at'])
            ->where([
                ['place_id', auth('api-owner')->user()->place->id]
            ])->with([
                'customerId' => function ($q) {
                    $q->select(['id', 'name', 'phone']);
                },
                'captionId' => function ($q) {
                    $q->select(['id', 'name', 'phone']);
                },
                'items.menuId' => function ($q) use ($itemName) {
                    $q->select(['id', $itemName]);
                },
                'items.sizeId' => function ($q) use ($sizeName) {
                    $q->select(['id', $sizeName]);
                },
                'items.AddOns' => function ($q) {
                    $q->select(['id', 'addon_id', 'order_item_id', 'quantity', 'price']);
                },
                'items.AddOns.addonId' => function ($q) use ($addOnName) {
                    $q->select(['id', $addOnName]);
                }
            ])->find($id);

        if (!$order) {
            return $this->returnError('404', 'Order Not Found Or Maybe Deleted');
        }

        return $this->returnData('order', $order);
    }// End OrderDetails

    public function orderCancel(Request  $request,$id) {

        try{
            DB::beginTransaction();
            $order =  Order::ownedBusiness()->find($id);

            if(!$order) {
                return $this->returnError('404', 'Sorry This Order Not Found Or Maybe Deleted');
            }
            $order->update([
                'status'    => 'Canceled'
            ]);

            $sendNotification = Notification::create([
                'sender'    => $order->place_id,
                'receive'   => $order->customer_id,
                'from'      => 'place',
                'to'        => 'customer',
                'order_id'  => $order->id,
                'place_id'  => $order->place_id,
                'message'   => 'تم الغاء الطلب من قبل المطعم',
                'readed'    => 0,
                'status'    => 1,
            ]);
            DB::commit();
            return $this->returnSuccessMessage('تم الغاء الطلب بنجح');

        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('',$e->getMessage());
        }
    }// End Cancel Order

    public function acceptPendingOrder($id) {
        DB::beginTransaction();
        try{
           $order = Order::where([
               ['place_id',  auth('api-owner')->user()->place->id],
               ['status','Pending']
           ])->with([
                'placeId' => function($q) {
                    $q->select(['id','longitude', 'latitude']);
                }
           ])->find($id);

           if(!$order) {
               return $this->returnError('404', 'Order Not Found Or Delete');
           }
            // Assign Longitude And Latitude To Var
           $placeLongitude =$order->placeId->longitude;
           $placeLatitude = $order->placeId->latitude;
            // Try To Find A Caption Who Dont have Order And Online
            $caption = Caption::query();
            $caption->where([
               ['status', 1], // Status 1 = Are Not Block From Dashboard
               ['online', 1], // Online 1 = True Online
               ['have_order', 0] // Dont Have Order  = 0
           ]);
            $query = $caption->selectRaw("*,(6371 * acos( cos( radians(" . $placeLatitude .") ) * cos( radians(latitude ) ) * cos( radians(longitude ) - radians(" . $placeLongitude .") ) + sin( radians(". $placeLatitude  .") ) * sin( radians( latitude ) ) ) ) AS distance ")
                ->havingRaw('distance < 10')->orderBy('distance');
           $caption =  $query->first();

           // Check If Find Caption Do Sometimes

            if($caption) {
                $statusCaption = true;
                $hireCaption = $caption->id;
                $message = 'تم الموفقة على الاوردر و الكابتن فى الطريق اليك';

                // Update Have_Order Of Caption To Have
                $caption->update([
                    'have_order'    => 1
                ]);
                // Send Notification To Caption
                $customerNotification = Notification::create([
                    'sender' => $order->place_id,
                    'receive' => $caption->id,
                    'from'   => 'place',
                    'to'     => 'caption',
                    'order_id'   => $order->id,
                    'place_id'      =>$order->place_id,
                    'message'    => 'لديك اوردر جديد قم بذهاب الى المكان فى الحال',
                    'readed'     => 0,
                    'status'     => 1,
                ]);
            }else {
                // Else Not Find The Caption
                $statusCaption = false;
                $hireCaption = NULL;
                $message ='تم الموفقة على الاوردر وجارى البحث عن الكابتن';
            }
            // Update Status Of Order To Search For Caption To Delivered It To Customer
            $order->update([
                'status' => 'Preparing',
                'caption_id' => $hireCaption
            ]);

            // Send Notification To Customer
            $customerNotification = Notification::create([
                'sender' => $order->place_id,
                'receive' => $order->customer_id,
                'from'   => 'place',
                'to'     => 'customer',
                'order_id'   => $order->id,
                'place_id'      =>$order->place_id,
                'message'    => 'تم الموفقع على الاوردر وجارى تحضير الاوردر',
                'readed'     => 0,
                'status'     => 1,
            ]);

            // Return Data
            DB::commit();
            return $this->returnData('caption',$statusCaption ,$message );

        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('',$e->getMessage());
        }
    }// End Accept Pending Order
}
