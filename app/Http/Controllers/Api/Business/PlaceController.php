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
    public function updateStatus(Request $request) {
        try{
            $rule = [
                'status'    => ['required', 'boolean']
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }
            $place = Place::where('owner_id', auth('api-owner')->user()->id)->first();

            if(!$place) {
                return $this->returnError('404', 'Place Not Found Or Delete Try Later');
            }
            $place->update([
                'status' => $request->status
            ]);
            // Login
            return $this->returnSuccessMessage('Status Of Place Updated Successfully');
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
