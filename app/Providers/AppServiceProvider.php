<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\FilterService;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Pagination\Paginator;
use App\Services\Impl\AuthServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\FilterServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use App\Services\Impl\CategoryServiceImpl;

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

        $this->app->bind(
            FilterService::class,
            FilterServiceImpl::class
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
