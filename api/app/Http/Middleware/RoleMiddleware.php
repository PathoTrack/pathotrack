<?php

namespace PathoTrack\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle($request, Closure $next)
    {
        $user_id = Authorizer::getResourceOwnerId();
        Auth::loginUsingId($user_id);

        if ($request->is('*v1/open/*') || $request->is('*v1/staff/*') || $request->is('*v1/vendor/*') || $request->is('*v1/admin/*')) {
            if (!Auth::user()->hasAtleastOneRole()) {
                abort(403, 'Access denied');
            }
        }

        if ($request->is('*v1/admin/*')) {
            if (!Auth::user()->isAdmin()) {
                abort(403, 'Access denied');
            }
        }

        if ($request->is('*v1/staff/*')) {
            if (!Auth::user()->isStaff()) {
                abort(403, 'Access denied');
            }
        }

        if ($request->is('*v1/vendor/*')) {
            if (!Auth::user()->isVendor()) {
                abort(403, 'Access denied');
            }
        }

        return $next($request);
    }
}
