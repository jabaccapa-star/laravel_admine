<?php

namespace De\AdminAuth;

use De\AdminAuth\Http\Middleware\EnsureAdministrator;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(Router $router): void
    {
        $router->aliasMiddleware('admin', EnsureAdministrator::class);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin-auth');
    }
}
