<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthInfoTrait
{

    protected function AuthInfo() {
        return Auth::user();
    }
}
