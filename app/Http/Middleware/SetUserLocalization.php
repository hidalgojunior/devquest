<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetUserLocalization
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $locale = $user->locale ?: config('app.locale');
            App::setLocale($locale);
            \Carbon\Carbon::setLocale($locale);

            $timezone = $user->timezone ?: config('app.timezone');
            date_default_timezone_set($timezone);
        }

        return $next($request);
    }
}
