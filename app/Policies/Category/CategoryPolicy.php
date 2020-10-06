<?php

namespace App\Policies\Category;

use App\Models\V1\Category\Category;
use App\Models\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
     * @param  \App\Choice   $category
     * @return mixed
     */
    public function view(User $user, Category $category)
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
     * @param  \App\Choice   $category
     * @return mixed
     */
    public function update(User $user,Category $category)
    {
        return $this->check($user, $category);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Choice   $category
     * @return mixed
     */
    public function trash(User $user,Category $category)
    {
        return $this->check($user, $category);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Choice   $category
     * @return mixed
     */
    public function restore(User $user,Category $category)
    {
        return $this->check($user, $category);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Choice   $category
     * @return mixed
     */
    public function forceDelete(User $user,Category $category)
    {
        return $this->check($user, $category);
    }
    public function check(User $user,Category $category)
    {
        return $user->id=== $category->created_by_id;
    }
}
