<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');

        /*View::composer('includes.admin.sidebar', function ($view) {
            $view->with('adsCount', Ad::count());
        });*/
    }

    //???
    protected $namespace = 'App\\Http\\Controllers';
}
