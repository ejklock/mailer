<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard) {
            switch ($guard) {
                case 'aduser':
                    $login = 'painel.email.index';
                    break;
                default:
                    '';
            }
            //return redirect()->route($login);
        }

        return $next($request);
    }
}
