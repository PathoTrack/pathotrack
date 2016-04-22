<?php

namespace PathoTrack\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \PathoTrack\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        // \PathoTrack\Http\Middleware\VerifyCsrfToken::class,
        'LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware'
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \PathoTrack\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \PathoTrack\Http\Middleware\RedirectIfAuthenticated::class,
        'csrf' => 'PathoTrack\Http\Middleware\VerifyCsrfToken'
    ];
}
