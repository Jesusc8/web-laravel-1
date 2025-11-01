<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id; //true or false
    }

    public function update(User $user, Post $post)
    {
        $isOwner = $user->id === $post->user_id;

        $isEmpty = $post->answers()->count() === 0 && $post->comments()->count() === 0;

        return $isOwner && $isEmpty; //true, false
    }
}
