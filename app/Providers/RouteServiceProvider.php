<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
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
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $this->mapApiV1Routes();
        $this->mapApiFallBackRoute();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiV1Routes()
    {
        Route::prefix('api/v1/admin')
            ->middleware('api')
            ->namespace($this->namespace)
            ->name('api.v1.admin.')
            ->group(function ($router) {
                foreach (glob(base_path('routes/api/v1/admin/*.php')) as $eachRoute) {
                    require $eachRoute;
                }
            });

        Route::prefix('api/v1/auth')
            ->middleware('api')
            ->namespace($this->namespace)
            ->name('api.v1.auth.')
            ->group(function ($router) {
                foreach (glob(base_path('routes/api/v1/auth/*.php')) as $eachRoute) {
                    require $eachRoute;
                }
            });

        Route::prefix('api/v1/site')
            ->middleware('api')
            ->namespace($this->namespace)
            ->name('api.v1.site.')
            ->group(
                function ($router) {
                    foreach (glob(base_path('routes/api/v1/site/*.php')) as $eachRoute) {
                        require $eachRoute;
                    }
                }
            );
    }

    protected function mapApiFallBackRoute(){
        Route::prefix('api')
            ->middleware('api')->group(
                function ($router) {
                    $router->fallback("$this->namespace\API\V1\FallbackController");
                }
            );
    }
}