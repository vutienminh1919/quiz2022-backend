<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryImpl;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\Impl\CategoryRepository;
use App\Repositories\Repository;
use App\Services\CategoryServiceImpl;
use App\Services\Impl\CategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Repository::class, EloquentRepository::class);
        $this->app->singleton(CategoryServiceImpl::class, CategoryService::class);
        $this->app->singleton(CategoryRepositoryImpl::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
