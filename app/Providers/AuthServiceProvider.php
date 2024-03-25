<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Idea;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        Gate::define('admin', function (User $user): bool {
            return (bool)$user->is_admin;
        });

//        Gate::define('edit-idea', function (User $user, Idea $idea): bool {
//            return ($user->is_admin || $user->id === $idea->user_id);
//        });
//
//        Gate::define('edit-comment', function (User $user, Comment $comment): bool {
//            return ($user->is_admin || $user->id === $comment->user_id);
//        });
    }
}
