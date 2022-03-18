<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    use GeneralTrait, LanguageTrait;

    /**
     * this for order [pending,preparing , accepted, On Way]
     * @param Request $request
     * @return JsonResponse
     */
    public function inDeal(Request $request) {
        $name = $this->LanguageData('language', 'name', 'placeName',  $request);

        $order =  Order::where('customer_id' , '=', auth()->user()->id)
            ->whereIn('status', ['Pending', 'Preparing', 'On-Way'])
            ->with([
                'placeId'   => function($q) use($name){
                    $q->select(['id', $name]);
                },

                'captionId'
            ])->latest()
            ->first();

        return $this->returnData('order' , $order);
    }// End Process


    public function destroyPendingOrder(Request $request) {
        DB::beginTransaction();
        try {
            DB::commit();
            $rule = [
                'order' => ['required', Rule::exists('orders', 'id')
                ->where('customer_id', auth()->user()->id)
                ->where(  'status', 'Pending')]
            ];
            $validator = Validator::make($request->all(),$rule);

            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }

            $order = Order::where([
                ['status' , 'Pending'],
                ['place_id', auth()->user()->id]
            ])
                ->with(['items.AddOns'])
                ->find($request->order);


           foreach($order->items as $item) {

               foreach($item['AddOns'] as $addOn) {
                   $addOn->delete();// Delete Addons
               }// End Foreach Items Add Ons

               $item->delete(); // Delete Items
           };// End Foreach Of Order->Item

            $order->delete(); // Delete Order

            return $this->returnSuccessMessage('تم حذف الاوردر');
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('',$e->getMessage());

        }
    }// End DestroyPendingOrder

    public function pastOrders(Request $request) {

        $placeName = $this->LanguageData('language', 'name', 'placeName', $request);

        $orders = Order::where([
            ['status', 'Delivered'],
            ['customer_id', auth()->user()->id],
        ])  ->with([
            'placeId' => function($q)  use($placeName){
                $q->select(['id', $placeName, 'thumb']);
            }
        ])->latest()
        ->paginate(config('setting.LimitPaginate'));

        return $this->returnData('orders', $orders);
    }// End Past Orders
}
