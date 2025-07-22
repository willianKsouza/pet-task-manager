<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthLoginServiceInterface;
use App\Service\Auth\LoginService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(AuthLoginServiceInterface::class, LoginService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
