<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function published(?User $user, Post $post)
    {
        if ($post->status == 2) {
            return true;
        } else {
            return false;
        }
    }
}
