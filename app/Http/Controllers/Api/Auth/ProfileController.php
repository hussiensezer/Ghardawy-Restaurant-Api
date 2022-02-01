<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function profile(Request $request) {
       $token = $request->header('auth-token');
       return auth()->user();
   }// End Profile
}
