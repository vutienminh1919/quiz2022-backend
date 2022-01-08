<?php

namespace App\Providers;

use App\Repositories\CategoryRepo;
use App\Repositories\CRUDinterfaceRepo;


use App\Repositories\Eloquent\EloquentRepo;
use App\Services\CategoryService;
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
        $this->app->singleton(CRUDinterfaceRepo::class, EloquentRepo::class);

        $this->app->singleton(CategoryService::class);
        $this->app->singleton(CategoryRepo::class);

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
