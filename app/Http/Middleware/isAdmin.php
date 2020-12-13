<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isAdmin
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
        $user = Auth::user()->admin;
        if (!$user==1) {
            Session::flash('no_permission','شما اجازه دسترسی به پنل مدیریت را ندارید.');
            return redirect('/login');
        }
        return $next($request);
    }
}
