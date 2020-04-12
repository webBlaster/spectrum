<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

use App\Policies\AdminPolicy;

use App\Admin;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       
        Gate::define('isAdmin', function($user) {
            return $user->status === 1;
        });
        Gate::define('isSuperAdmin', function(Admin $admin) {
            return $admin->status === 1 && $admin->is_super_admin === 1;
        });

        Passport::routes();

        // Passport::tokensExpireIn(now()->addDays(15));

        // Passport::refreshTokensExpireIn(now()->addDays(30));
    
        Passport::personalAccessTokensExpireIn(now()->addMinutes(60));
        //
    }
}
