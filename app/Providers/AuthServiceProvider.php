<?php

namespace CodEditora\Providers;

use CodEditora\Models\Livro;

use CodeEduUser\Models\User;
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


        Gate::define('update-livro', function ($user, $livro) {
            return $user->id == $livro->user_id;
        });

    }
}
