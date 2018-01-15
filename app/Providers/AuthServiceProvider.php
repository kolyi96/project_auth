<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Permission;
use App\Policies\PermissionPolicy;
use App\User;
use App\Policies\UserPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Permission::class => PermissionPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('VIEW_ADMIN',function($user){
            return $user->canDo(['VIEW_ADMIN'],false);
        });
        
        $gate->define('EDIT_USERS',function($user){
            return $user->canDo(['EDIT_USERS'],false);
        });
        
        $gate->define('EDIT_PERMISSIONS',function($user){
            return $user->canDo(['EDIT_PERMISSIONS'],false);
        });
    }
}
