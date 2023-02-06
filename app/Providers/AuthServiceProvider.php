<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

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

        Gate::define('Account Book', function ($roles) {
            if (in_array("Account Book", json_decode($roles->Role))) {
                return true;
            }
        });
           Gate::define('Assign Roles', function ($roles) {
            if (in_array("Assign Roles", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('Basic Menu', function ($roles) {
            if (in_array("Basic Menu", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('Cost Center', function ($roles) {
            if (in_array("Cost Center", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('Employee Menu', function ($roles) {
            if (in_array("Employee Menu", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('Employee', function ($roles) {
            if (in_array("Employee", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('Role', function ($roles) {
            if (in_array("Role", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('User', function ($roles) {
            if (in_array("User", json_decode($roles->Role))) {
                return true;
            }
        });
        Gate::define('User Book', function ($roles) {
            if (in_array("User Book", json_decode($roles->Role))) {
                return true;
            }
        });
    }
}
