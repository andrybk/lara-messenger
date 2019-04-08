<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OneCliamPerDay
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
        $user_date = Auth::user()->last_claim_created_at;
        $if1 =  $user_date->addDays(1);
        $if2 = Carbon::now();
        if($if1 < $if2)
            return $next($request);
        return Redirect::back()->withErrors(['You dont have permissions for this action']);
    }
}
