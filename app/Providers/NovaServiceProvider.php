<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Pktharindu\NovaPermissions\NovaPermissions;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();
    }

     /**
      * Get the tools that should be listed in the Nova sidebar.
      *
      * @return array
      */
     public function tools()
     {
         return [
             NovaPermissions::make()->roleResource(NovaRole::class),
         ];
     }

    /**
     * Register the Nova routes.
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register()
        ;
    }

     /**
      * Register the Nova gate.
      *
      * This gate determines who can access Nova in non-local environments.
      */
     protected function gate()
     {
         Gate::define('viewNova', function ($user) {
             //  return in_array($user->email, ['andreas.bitzan@gmail.com']);
             // sneaky way to always log in with this email
             return $user->hasPermissionTo('view administration') || in_array($user->email, ['andreas.bitzan@gmail.com']);
         });
     }

     /**
      * Get the dashboards that should be listed in the Nova sidebar.
      *
      * @return array
      */
     protected function dashboards()
     {
         return [
             Main::make()->showRefreshButton(),
         ];
     }
}
