<?php

namespace App\Providers;

use App\Models\ImageVariable;
use App\Models\Webapp;
use App\Observers\ImageVariableObserver;
use App\Observers\WebappObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('admins', function($user){
            $admins = explode(',', trim(config('webapps.admins')));
            //terá que ser algum outro parâmetro, pois há a possibilidade de logar no sistema sem codpes.
            return in_array($user->codpes ?? $user->id, $admins); 
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ImageVariable::observe(ImageVariableObserver::class);
        Webapp::observe(WebappObserver::class);
    }
}
