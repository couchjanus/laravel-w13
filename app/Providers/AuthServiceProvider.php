<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Admin;
// use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(
            'update-post',
            function ($user, $post) {
                return $user->id == $post->user_id;
            }
        );
        Gate::define(
            'destroy-post',
            function ($user, $post) {
                return $user->id == $post->user_id;
            }
        );

        // Gate::before(function (Admin $user, $ability) {
        //     if ($user->isSuperAdmin()) {
        //         return true;
        //     }
        // });

        // Gate::define('super-admin', function ($user) {
        //     if($user->is_super) {   
        //         return true;   
        //     }
        //     return false;
        // });

        // Gate::after(function ($user, $ability, $result, $arguments) {
        //     if ($user->isSuperAdmin()) {
        //         return true;
        //     }
        // });

        // $this->getPermissions()->each(function (Permission $permission) {
        //     $ability = $permission->slug;
        //     $policy  = function ($user) use ($permission) {
        //         return $user->hasRole($permission->roles);
        //     };

        //     Gate::define($ability, $policy);
        // });

        // Gate::before(function ($user, $ability) {
        //     return $user->hasRole('Super Admin') ? true : null;
        // });
    }

    private function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
