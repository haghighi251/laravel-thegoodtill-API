<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThegoodtillAuth
{
    /**
     * We must redirect user to login route if there is no session for Thegoodtill.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // We should redirect user to login route if there is no user_id session.
        if(false === $request->session()->has('user_id')){
            return redirect('/login');
        }
        return $next($request);
    }
}
