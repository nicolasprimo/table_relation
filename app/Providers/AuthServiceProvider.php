<?php

namespace App\Providers;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        // Gate::before(function ($user) {
        //     if ($user->role_id == 1) {
        //         return true;
        //     }
        // });

        Gate::define('AdminView', 'App\Policies\AdminPolicy@view');

        Gate::define('AdminUpdate', 'App\Policies\AdminPolicy@update');
    }
}