<?php

namespace App\Http\Controllers\Api\Caption\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use GeneralTrait;
    public function profile(Request $request) {
        $token = $request->header('auth-token');
        return $this->returnData('profile', auth()->user());
    }// End Profile
}
