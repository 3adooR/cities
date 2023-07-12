<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAnotherCountry
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->getClientIp();
        $geoIp = geoip()->getLocation($ip);
        if ($geoIp->iso_code !== 'IL') {
            return redirect('/forbidden-country');
        }

        return $next($request);
    }
}
