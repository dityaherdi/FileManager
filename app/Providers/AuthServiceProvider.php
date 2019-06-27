<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk hak akses user
        Gate::define('view', function($user) {
            if ($user->isAdmin) {
                return true;
            }

            return $user->permission->view;
        });

        Gate::define('create', function($user) {
            if ($user->isAdmin) {
                return true;
            }

            return $user->permission->create;
        });

        Gate::define('update', function($user) {
            if ($user->isAdmin) {
                return true;
            }

            return $user->permission->update;
        });

        Gate::define('delete', function($user) {
            if ($user->isAdmin) {
                return true;
            }

            return $user->permission->delete;
        });

        Gate::define('download', function($user) {
            if ($user->isAdmin) {
                return true;
            }
            
            return $user->permission->download;
        });

        Gate::define('isAdmin', function($user) {
            return $user->isAdmin;
        });

        Gate::define('isManager', function($user) {
            return $user->isManager;
        });

        // Gate::define('renderOptionsButton', function($user) {
        //     if ($user->isAdmin) {
        //         return true;
        //     } else if($user->permission->view || $user->permission->create || $user->permission->update || $user->permission->delete || $user->permission->download) {
        //         return true;
        //     }

        //     return false;
        // });
        // end gate
    }
}
