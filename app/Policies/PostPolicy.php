<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Admins bypass all policy checks automatically.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return true; // Admin can do anything
        }

        return null; // Fall through to specific checks for Editors
    }

    /** Any authenticated user can view the post list / a single post. */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /** Any authenticated user can create posts. */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Only the post's author (or admin via before()) can edit it.
     */
    public function update(User $user, Post $post): bool
    {
        return (int) $post->user_id === (int) $user->id;
    }

    /**
     * Only the post's author (or admin via before()) can delete it.
     */
    public function delete(User $user, Post $post): bool
    {
        return (int) $post->user_id === (int) $user->id;
    }

    /** Status toggle follows the same rule as update. */
    public function toggleStatus(User $user, Post $post): bool
    {
        return (int) $post->user_id === (int) $user->id;
    }
}
