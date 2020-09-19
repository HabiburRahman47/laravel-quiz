<?php

namespace App\Policies\Section;

use App\Model\V1\Section\Section;
use App\Model\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
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
     * @param  \App\Section  $section
     * @return mixed
     */
    public function view(User $user, Section $section)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function update(User $user, Section $section)
    {
        return $this->check($user,$section);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function trash(User $user, Section $section)
    {
        return $this->check($user,$section);
    }

    /**
     *
     *
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function restore(User $user, Section $section)
    {
        return $this->check($user,$section);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function forceDelete(User $user, Section $section)
    {
        return $this->check($user,$section);
    }
    public function check(User $user, Section $section)
    {
        return $user->id===$section->created_by_id;
    }
}
