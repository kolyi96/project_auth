<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferral
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
        if( $request->hasCookie('referral')) {
            return $next($request);
        }
        else {
            if( $request->query('friend') ) {
                $referal_id = intval($request->query('friend'));
                return redirect($request->fullUrl())->withCookie(cookie()->forever('referral', $referal_id));
            }
        }
        return $next($request);
    }
}
