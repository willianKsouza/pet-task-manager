<?php

namespace App\Providers;

use App\Interfaces\Task\CreateTaskServiceInterface;
use App\Service\Task\CreateTaskService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Task\GetAllTasksServiceInterface;
use App\Service\Task\GetAllTasksService;
use App\Interfaces\User\GetAllUsersServiceInterface;
use App\Service\User\GetAllUsersService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            GetAllUsersServiceInterface::class,
            GetAllUsersService::class
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
