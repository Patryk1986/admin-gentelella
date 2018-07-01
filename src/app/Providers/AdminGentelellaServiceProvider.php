<?php

namespace LiteCode\AdminGentelella\App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AdminGentelellaServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        include __DIR__ . '../../../routes/web.php';

        $this->publishes([
            __DIR__ . '../../../database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

        $this->publishes([
            __DIR__ . '../../../database/seeds' => $this->app->databasePath() . '/seeds'
        ], 'seeds');

//        $this->publishes([
//            __DIR__.'../../../app/Exceptions' => app_path() . '/Exceptions',
//            __DIR__.'../../../app/Http' => app_path() . '/Http',
//            __DIR__.'../../../app/Admin.php' => app_path() . '/Admin.php',
//            __DIR__.'../../../app/User.php' => app_path() . '/User.php',
//        ], 'app');
//
//
        $this->mergeConfigFrom(__DIR__.'../../../config/authGuards.php', 'auth.guards');
        $this->mergeConfigFrom(__DIR__.'../../../config/authProvider.php', 'auth.providers');
        $this->mergeConfigFrom(__DIR__.'../../../config/authPassword.php', 'auth.passwords');
//        $this->mergeConfigFrom(__DIR__.'../../../config/services.php', 'services');

        $this->publishes([
            __DIR__.'../../../config/adminauth.php' => config_path('adminauth.php')
        ], 'views');

        $this->publishes([
            __DIR__.'../../../resources/assets/' => public_path()
        ], 'assets');
//
//        $this->mergeConfigFrom(
//            __DIR__.'../../../config/ocauth.php', 'ocauth'
//        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /* REGISTER EXCEPTION HANDLER FOR guard: "auth:admin" - solve redirect if unauthenticated user hit admin url */
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \LiteCode\AdminGentelella\App\Exceptions\AdminauthHandler::class
        );

        /* THIS ONES WILL REGISTER INTO: app\Http\Kernel.php => protected $middlewareGroups = []; */
        $this->app['router']->pushMiddlewareToGroup('admin', \App\Http\Middleware\EncryptCookies::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Session\Middleware\StartSession::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\View\Middleware\ShareErrorsFromSession::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \App\Http\Middleware\VerifyCsrfToken::class);
        $this->app['router']->pushMiddlewareToGroup('admin', \Illuminate\Routing\Middleware\SubstituteBindings::class);

        /* THIS ONE WILL REGISTER INTO: app\Http\Kernel.php => protected $routeMiddleware = []; */
        $this->app['router']->aliasMiddleware('admin', \LiteCode\AdminGentelella\App\Http\Middleware\RedirectAuthenticatedAdmin::class);

        // Bind occrud package
        //$this->app->register('Militaruc\Occrud\App\Providers\OCCrudServiceProvider');

        //$loader = \Illuminate\Foundation\AliasLoader::getInstance();
        //$loader->alias('Occrud', 'Militaruc\Occrud\Facade');

        // register controllers
        //$this->app->make('Militaruc\Pone\App\Http\Controllers\PoneController');
        //$this->app->make('Militaruc\Occrud\App\Libraries\ParseDoc');


        // register views
        $this->loadViewsFrom(__DIR__.'../../../resources/views/backend/', 'admin');
    }
}
