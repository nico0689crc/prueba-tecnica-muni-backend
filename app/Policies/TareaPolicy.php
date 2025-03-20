<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tarea;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TareaPolicy
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
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tarea $tarea)
    {
        if ($user->esAdministrador()) {
            return Response::allow();
        }

        if ($tarea->usuarios->contains($user)) {
            return Response::allow();
        }

        return Response::deny('No eres el dueño de la tarea');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tarea $tarea)
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
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tarea $tarea)
    {
        if ($user->esAdministrador()) {
            return Response::allow();
        }

        if ($tarea->usuarios->contains($user)) {
            return Response::allow();
        }

        return Response::deny('No eres el dueño de la tarea');
    }
}
