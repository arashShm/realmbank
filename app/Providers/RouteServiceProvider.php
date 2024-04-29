<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
            // ->prefix('api')
            ->group(base_path('routes/api/webApi.php'));

            Route::middleware(['api' , 'auth' , 'auth.admin'])
                // ->prefix('api')
                ->name('admin.')
                ->prefix('api.admin')
                ->group(base_path('routes/api/adminApi.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/web.php'));

            Route::middleware(['web', 'auth', 'auth.admin'])
                ->name('admin.')
                ->prefix('admin')
                ->group(base_path('routes/web/admin.php'));
        });
    }
}
