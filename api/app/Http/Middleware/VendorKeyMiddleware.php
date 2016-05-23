<?php

namespace PathoTrack\Http\Middleware;

use Closure;
use PathoTrack\Vendor;

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
        } else {
            $vendor = Vendor::findVendor($vendor_key);
            if (sizeof($vendor) < 1) {
                abort(403, 'Access denied');
            }
        }
        
        return $next($request);
    }
}
