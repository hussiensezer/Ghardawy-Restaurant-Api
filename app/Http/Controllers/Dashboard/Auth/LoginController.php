<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {

        return view("auth.login");

    }// End Login

    public function loginProcess(Request $request) {


        try {
            $rules = $request->validate( [
                'phone'     => 'required|exists:admins,phone',
                'password'  => 'required|min:6|max:12',
            ]);
            $credentials = $request->only(['phone', 'password']);

            $admin =  Auth::guard("admins")->attempt($credentials);

            if($admin) {
                return redirect()->intended('dashboard/home');

            }
            return back();
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }
}
