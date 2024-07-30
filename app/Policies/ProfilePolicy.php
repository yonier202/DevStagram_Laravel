<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
   

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $user): bool
    {
    // El usuario autenticado solo puede editar su propio perfil
    return $authUser->id === $user->id;
    }
}
