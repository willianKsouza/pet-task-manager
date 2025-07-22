<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthLoginServiceInterface;
use App\Interfaces\Task\CreateTaskServiceInterface;
use App\Service\Auth\LoginService;
use App\Service\Task\CreateTaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            CreateTaskServiceInterface::class,
            CreateTaskService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
