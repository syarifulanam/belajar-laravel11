<?php

namespace App\Policies;

use App\Models\User;
use App\Models\blog;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        // return $user->active == 1;
        // return $user->active == 1
        //     ? Response::allow()
        //     : Response::deny('You must be active to see blog list');

        return $user->active == 1
            ? Response::allow()
            : Response::deny('Akun login Anda tidak aktif. Hubungi admin untuk mengaktifkan akun Anda.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, blog $blog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, blog $blog): Response
    {
        // return $user->id == $blog->author_id;
        return $user->id == $blog->author_id
            ? Response::allow()
            : Response::deny('You must be the author to edit this blog');
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, blog $blog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, blog $blog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, blog $blog): bool
    {
        return false;
    }
}
