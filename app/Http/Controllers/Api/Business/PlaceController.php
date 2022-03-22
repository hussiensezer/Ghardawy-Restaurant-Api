<?php

namespace App\Http\Controllers\Api\Business;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Place;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    use GeneralTrait;
    public function updateStatus() {
        try{

            $place = Place::where('owner_id', auth('api-owner')->user()->id)->first();

            if(!$place) {
                return $this->returnError('404', 'Place Not Found Or Delete Try Later');
            }

            $mode = $place->status == 1 ? 'Not Available': 'Available' ;
            $place->update([
                'status' => $place->status == 1 ? 0 : 1, //if status true will be false and else false will be true
            ]);

            return $this->returnData('mode' , $mode, 'Status Updated Successful');
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }// End UpdateStatus



    public function notifications(Request $request) {

        $notifications = Notification::select([
            'id','order_id','message','readed'
        ])->where([
            ['receive'   ,auth('api-owner')->user()->place->id],
            ['to'        , 'place'],
            ['place_id'  , auth('api-owner')->user()->place->id]
        ])->latest()->paginate(config('setting.LimitPaginate'));
//        ->take(config('setting.notification_limit'))->get()

        return $this->returnData('notifications', $notifications);
    }// End Notifications


    public function someNotifications(Request $request) {

        $notifications = Notification::select([
            'id','order_id','message','readed'
        ])->where([
            ['receive'   ,auth('api-owner')->user()->place->id],
            ['to'        , 'place'],
            ['place_id'  , auth('api-owner')->user()->place->id]
        ])->latest()->take(config('setting.notification_limit'))->get();


        return $this->returnData('notifications', $notifications);
    }// End Notifications
}
