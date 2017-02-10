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


        \Gate::define('update-book', function ($user, $book) {
            return $user->id == $book->author_id;
        });

        \Gate::before(function ($user, $ability) {
           if ($user->isAdmin()){
               return true;
           };
        });

    }
}
