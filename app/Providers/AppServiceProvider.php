<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\Impl\CategoryServiceImpl;
use App\Services\ProductService;
use Illuminate\Pagination\Paginator;
use App\Services\Impl\AuthServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\ProductServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductService::class,
            ProductServiceImpl::class
        );

        $this->app->bind(
            AuthService::class,
            AuthServiceImpl::class
        );

        $this->app->bind(
            CategoryService::class,
            CategoryServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
