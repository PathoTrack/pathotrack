<?php

namespace PathoTrack\Http\Middleware;

use Closure;

class VendorKeyMiddleware
{

    public function handle($request, Closure $next)
    {
        $vendor_key = null;

        if (isset(getallheaders()['vendor_key'])) {
            $vendor_key = getallheaders()['vendor_key'];
        }

        if (is_null($vendor_key)) {
            abort(403, 'Access denied');
        }
        
        return $next($request);
    }
}
