<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class DataComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Aqui é aonde vai disponibilizar para todo mundo as info do data composer que disponibiliza as news e contatos pra mostrar como notificação na adm
        View::composer(['adm.includes.header', 'adm.home', 'adm.login.login-index'], 'App\Http\View\Composers\DataComposer');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
