<?php

namespace App\Policies\Property;

use App\Models\V1\Property\PropertyType;
use App\Models\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyTypePolicy
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
     * @param  \App\InstitutionType  $institutionType
     * @return mixed
     */
    public function view(User $user, PropertyType $propertyType)
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
     * @param  \App\InstitutionType  $institutionType
     * @return mixed
     */
    public function update(User $user, PropertyType $propertyType)
    {
        return $this->check($user,  $propertyType);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\InstitutionType  $institutionType
     * @return mixed
     */
    public function trash(User $user, PropertyType $propertyType)
    {
        return $this->check($user,  $propertyType);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\InstitutionType  $institutionType
     * @return mixed
     */
    public function restore(User $user, PropertyType $propertyType)
    {
        return $this->check($user,  $propertyType);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\InstitutionType  $institutionType
     * @return mixed
     */
    public function forceDelete(User $user, PropertyType $propertyType)
    {
        return $this->check($user,  $propertyType);
    }

    public function check(User $user, PropertyType $propertyType)
    {
        return $user->id === $propertyType->created_by_id;
    }
}
