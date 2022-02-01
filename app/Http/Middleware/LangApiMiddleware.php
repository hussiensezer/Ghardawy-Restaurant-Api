<?php

namespace App\Http\Middleware;

use Closure;

class LangApiMiddleware
{

    public function handle($request, Closure $next)
    {
        app()->setLocale('en');
        if($request->header('language') && $request->header('language') == 'ar' ) {
            app()->setLocale('ar');
        }elseif($request->header('language') && $request->header('language') == 'ru' ) {
            app()->setLocale('ru');
        }
        return $next($request);
    }
}
