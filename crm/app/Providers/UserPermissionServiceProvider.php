<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class UserPermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('view-users', fn(User $user) => $user->role === 'admin');
        Gate::define('delete-user', fn(User $user, User $target) => $user->role === 'admin' && $user->id !== $target->id);
    }
}
