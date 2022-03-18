<?php

namespace App\Http\Controllers\Api\Caption\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use GeneralTrait;
    public function login(Request $request) {

        try{

            $validation =
                [
                    'phone'     => ['required'],
                    'password'  => ['required', 'min:6' , 'max:12']
                ];
            $validator = Validator::make($request->all(),$validation);

            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }

            $credentials = $request->only(['phone', 'password']);
            $caption = Auth::guard('api-caption')->attempt($credentials);

            if(!$caption) {
                return $this->returnError('E001', __('auth.failed'));
            }
            $data['token'] = $caption;
            return $this->returnData("LoginInfo", $data);
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }
}
