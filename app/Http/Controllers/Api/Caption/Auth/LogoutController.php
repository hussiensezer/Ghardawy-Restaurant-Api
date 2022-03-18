<?php

namespace App\Http\Controllers\Api\Caption\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    use GeneralTrait;
    public function logout(Request $request) {
        $token = $request->header('auth-token');
        if($token) {
            try{
                JWTAuth::setToken($token)->invalidate(); // Logout
                return $this->returnSuccessMessage("Logout Successfully");
            }
            catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return   $this->returnError("", "Something went wrong....." );
            }
        }
        else {
            return   $this->returnError("", "Something went wrong.....");
        }
    }
}
