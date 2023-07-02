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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    public const ADMIN = '/admin/dashboard';
    public const VENDOR = '/vendor/dashboard';

    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        // $this->mapWebRoutes();

        $this->mapWebSiteRoutes();

        $this->mapAdminRoutes();

        $this->mapVendorRoutes();

        //
    }

 
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    protected function mapWebSiteRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/site.php'));
    }
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapVendorRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/vendor.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
