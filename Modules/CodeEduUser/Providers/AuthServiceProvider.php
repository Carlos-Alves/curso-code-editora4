<?php

namespace CodeEduUser\Providers;

use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodeEduUser\Repositories\PermissionRepository;
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
        'CodEditora\Model' => 'CodEditora\Policies\ModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(function ($user, $ability) {
           if ($user->isAdmin()){
               return true;
           }
        });

        if (!app()->runningInConsole()|| app()->runningUnitTests()){
            /** @var PermissionRepository $permissionRepository */
            $permissionRepository = app(PermissionRepository::class);
            $permissions = $permissionRepository->all();
            foreach ($permissions as $p){
                \Gate::define("{$p->name}/{$p->resource_name}", function($user) use($p){
                    return $user->hasRole($p->roles);
                });
            }
        }



    }
}
