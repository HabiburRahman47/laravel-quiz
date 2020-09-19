<?php

namespace App\Policies\Department;

use App\Model\V1\Department\Department;
use App\Model\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Model\V1\User\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function view(User $user, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\V1\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function update(User $user, Department $department)
    {
        return $this->check($user,$department);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function trash(User $user, Department $department)
    {
        return $this->check($user,$department);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function restore(User $user, Department $department)
    {
        return $this->check($user,$department);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function forceDelete(User $user, Department $department)
    {
        return $this->check($user,$department);
    }
    public function check(User $user, Department $department)
    {
        return $user->id===$department->created_by_id;
    }
}
