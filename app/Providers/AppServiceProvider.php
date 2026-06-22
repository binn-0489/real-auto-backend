<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\AdminPolicy;

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
        Gate::policy(User::class, AdminPolicy::class);
        /*View::composer('includes.admin.sidebar', function ($view) {
            $view->with('adsCount', Ad::count());
        });*/
    }

    //???
    protected $namespace = 'App\\Http\\Controllers';
}
