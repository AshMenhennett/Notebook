<?php

namespace App\Providers;

use App\Note;
use App\NoteBook;
use App\Policies\NotePolicy;
use App\Policies\NoteBookPolicy;
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
        'App\NoteBook' => 'App\Policies\NoteBookPolicy',
        'App\Note' => 'App\Policies\NotePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('create-note', function ($user, $notebook) {
        //     return $user->id === $notebook->user_id;
        // });
        //
    }
}
