<?php

namespace App\Providers;

use App\Interfaces\Task\CreateTaskRepositoryInterface;
use App\Interfaces\User\GetAllUsersServiceInterface;
use App\Repositories\Task\CreateTaskRepository;
use App\Service\User\GetAllUsersService;
use Illuminate\Support\ServiceProvider;

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

        $this->app->bind(
            CreateTaskRepositoryInterface::class,
            CreateTaskRepository::class
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
