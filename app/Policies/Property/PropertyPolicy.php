<?php

namespace App\Policies\Property;

use App\Models\V1\Property\Property;
use App\Models\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
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
     * @param  \App\Property  $institution
     * @return mixed
     */
    public function view(User $user, Property $property)
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
     * @param  \App\Property  $institution
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return $this->check($user, $property);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Property  $institution
     * @return mixed
     */
    public function trash(User $user, Property $property)
    {
        return $this->check($user, $property);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Property  $institution
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        return $this->check($user, $property);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Property  $institution
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        return $this->check($user, $property);
    }

    public function check(User $user, Property $property)
    {
        return $user->id === $property->created_by_id;
    }
}
