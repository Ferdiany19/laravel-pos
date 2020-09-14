<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class Kasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrfail(Auth::id())->role_users()->first()->name;
        if($user === 'Kasir'){
            return $next($request);
        }
        return abort(403,'ini untuk halaman admin');
    }
}
