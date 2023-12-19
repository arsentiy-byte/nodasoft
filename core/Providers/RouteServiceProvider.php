<?php

declare(strict_types=1);

namespace Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 */
final class RouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
