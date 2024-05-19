<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Emploi;
use App\Models\Conversation;

use Illuminate\Auth\Access\Response;

class EmploiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */         // User $user, Emploi $emploi)
    public function view(

    User $user, Emploi $emploi, Conversation $conversation): bool
    {
        if ($user->id === $conversation->from) {
            return $user->id === $emploi->user_id;
        } else {
            return $user->proposals->contains(function ($value, $key) use ($emploi, $conversation, $user) {
                return $value['validated'] == 1
                    && $value['emploi_id'] == $emploi->id
                    && $conversation->to === $user->id;
            });
        }
    }

    public function confirm(User $user, Emploi $emploi): bool
    {
        return $user->id === $emploi->user_id;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Emploi $emploi): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Emploi $emploi): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Emploi $emploi): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Emploi $emploi): bool
    {
        //
    }
}
