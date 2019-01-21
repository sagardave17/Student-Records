<?php

namespace App\Providers;

use App\Role;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();


        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_details', function ($user) {
            return in_array($user->role_id, [2]);
        });
        Gate::define('data', function ($user) {
            return in_array($user->role_id, [2]);
        });

        // Auth gates for: Semester
        Gate::define('semester_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('semester_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('semester_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('semester_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('semester_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Subjects
        Gate::define('subject_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('subject_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('subject_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('subject_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('subject_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Marks
        Gate::define('mark_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('mark_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('mark_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('mark_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('mark_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Degree
        Gate::define('degree_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('degree_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('degree_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('degree_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('degree_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
