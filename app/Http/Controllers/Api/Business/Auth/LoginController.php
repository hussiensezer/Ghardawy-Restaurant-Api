<?php

namespace App\Http\Controllers\Api\Business\Auth;

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
            $user = Auth::guard('api-owner')->attempt($credentials);

            if(!$user) {
                return $this->returnError('E001', __('auth.failed'));
            }
            $data['token'] = $user;
            return $this->returnData("LoginInfo", $data);
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }
}
