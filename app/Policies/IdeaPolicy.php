<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function workWith(User $user, Idea $idea): bool
    {
        return $idea->user->is($user);
    }
}
