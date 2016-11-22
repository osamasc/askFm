<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // $auth = Auth::guard('web')->user()->id;
        //  view()->share(['auth'=> $auth ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
