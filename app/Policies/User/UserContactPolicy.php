<?php

namespace App\Policies\User;

use App\Models\V1\User\User;
use App\Models\V1\UserContact\UserContact;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\V1\User\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\UserContact  $userContact
     * @return mixed
     */
    public function view(User $user, UserContact $userContact)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\V1\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\UserContact  $userContact
     * @return mixed
     */
    public function update(User $user, UserContact $userContact)
    {
        return $this->check($user,$userContact);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\UserContact  $userContact
     * @return mixed
     */
    public function trash(User $user, UserContact $userContact)
    {
        return $this->check($user,$userContact);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\UserContact  $userContact
     * @return mixed
     */
    public function restore(User $user, UserContact $userContact)
    {
        return $this->check($user,$userContact);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\UserContact  $userContact
     * @return mixed
     */
    public function forceDelete(User $user, UserContact $userContact)
    {
        return $this->check($user,$userContact);
    }
    public function check(User $user, UserContact $userContact)
    {
        return $user->id===$userContact->created_by;
    }
}
