<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\User;
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
        if (Auth::guard($guard)->check()) {
            $user = User::findOrfail(Auth::id());
            if($user->role_users()->first()->name === 'Admin'){
                return redirect('/admin');
            }elseif($user->role_users()->first()->name === 'Kasir'){
                return redirect('/kasir');
            }elseif($user->role_users()->first()->name === 'Management'){
                return redirect('/management');
            }
        }

        return $next($request);
    }
}
