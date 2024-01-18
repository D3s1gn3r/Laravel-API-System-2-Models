<?php

namespace App\Providers;

use App\Services\Permission\Interfaces\PermissionsServiceInterface;
use App\Services\Permission\UserPermissionsService;
use App\Services\User\Interfaces\UserAuthServiceInterface;
use App\Services\User\Interfaces\UserServiceInterface;
use App\Services\User\UserAuthService;
use App\Services\User\UserService;
use App\Services\Vehicle\Interfaces\VehicleServiceInterface;
use App\Services\Vehicle\VehicleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserAuthServiceInterface::class, UserAuthService::class);
        $this->app->bind(PermissionsServiceInterface::class, UserPermissionsService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(VehicleServiceInterface::class, VehicleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
