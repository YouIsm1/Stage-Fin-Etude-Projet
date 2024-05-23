<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthentificatonProvider extends ServiceProvider
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
        // Utilisateur authentifié disponible dans toutes les vues
        View::composer('*', function ($view) {
            $view->with('authUser', Auth::user());
            // $view->with('authUser', Auth::Utilisateur());
        });
    }
}
