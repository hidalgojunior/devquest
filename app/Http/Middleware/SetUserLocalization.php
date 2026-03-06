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
        // always force Brazilian Portuguese and UTC-3 regardless of user
        App::setLocale('pt_BR');
        \Carbon\Carbon::setLocale('pt_BR');
        date_default_timezone_set('America/Sao_Paulo');

        return $next($request);
    }
}
