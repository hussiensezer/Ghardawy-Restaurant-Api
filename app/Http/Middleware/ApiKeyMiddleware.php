<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Auth\AuthenticationException;

class ApiKeyMiddleware
{
    use GeneralTrait;
    public function handle($request, Closure $next)
    {
//        if($request->hasHeader('api_key')){
//
//        }
        if($request->header('api_key') !== config('setting.api_key')) {
            throw new AuthenticationException('Wrong api key');
        }
        return $next($request);
    }
}
