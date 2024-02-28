<?php
 
namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\Facades;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\MenuComposer;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Using class based composers...


        Facades\View::composer('main.components.header',MenuComposer::class);
        Facades\View::composer('main.components.cart',CartComposer::class);

    }
}