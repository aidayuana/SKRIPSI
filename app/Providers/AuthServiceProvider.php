<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define gate for reading configuration menu
        Gate::define('read konfigurasi/menu', function ($user) {
            // Logic to determine if $user has permission
            return $user->hasPermissionTo('read konfigurasi/menu');
        });

        // Define gate for updating roles
        Gate::define('update role', function ($user, $role) {
            // Assuming there's a method hasPermissionTo on the User model
            // Adjust the permission name as needed
            return $user->hasPermissionTo('update role');
            // You can also add more logic here if you need to check for specific role properties
            // For example: return $user->hasPermissionTo('update role') && $user->id === $role->user_id;
        });

        // Add more gates for other permissions as needed
    }
}
