<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.theme.app', function($view){
            // $productos = \App\Models\Producto::count();
            //

            $productos =  \App\Models\Producto::where('stock','<',5)->get();
            $view->with(['productos'=> $productos]);
            //dd($productos);
        });
    }
}
