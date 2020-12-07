<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('list-user' , ['App\Policies\UserPolicy' , 'list']);
        Gate::define('form-user' , ['App\Policies\UserPolicy' , 'form']);
        Gate::define('save-user' , ['App\Policies\UserPolicy' , 'save']);
        Gate::define('delete-user' , ['App\Policies\UserPolicy' , 'delete']);
        Gate::define('restore-user' , ['App\Policies\UserPolicy' , 'restore']);

        Gate::define('list-userType' , ['App\Policies\UserTypePolicy' , 'list']);
        Gate::define('form-userType' , ['App\Policies\UserTypePolicy' , 'form']);
        Gate::define('save-userType' , ['App\Policies\UserPolicy' , 'save']);
        Gate::define('delete-userType' , ['App\Policies\UserPolicy' , 'delete']);
        Gate::define('restore-userType' , ['App\Policies\UserPolicy' , 'restore']);
    }
}
