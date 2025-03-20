<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->esAdministrador()) {
            return Response::allow();
        }

        return Response::deny('No eres administrador');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->esAdministrador()) {
            return Response::allow();
        }

        return Response::deny('No eres administrador');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $usuario)
    {
        if ($user->esAdministrador() || $user->id === $usuario->id) {
            return Response::allow();
        }

        return Response::deny('No eres el dueño del usuario');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $usuario)
    {
        if ($user->esAdministrador() || $user->id === $usuario->id) {
            return Response::allow();
        }

        return Response::deny('No eres el dueño del usuario');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $usuario)
    {
        if ($user->esAdministrador()) {
            return Response::allow();
        }

        return Response::deny('No eres administrador');
    }
}
