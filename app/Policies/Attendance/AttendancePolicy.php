<?php

namespace App\Policies\Attendance;

use App\Model\V1\Attendance\Attendance;
use App\Model\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendancePolicy
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
     * @param  \App\Attendance  $attendance
     * @return mixed
     */
    public function view(User $user, Attendance $attendance)
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
     * @param  \App\Attendance  $attendance
     * @return mixed
     */
    public function update(User $user, Attendance $attendance)
    {
        return $this->check($user,$attendance);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Attendance  $attendance
     * @return mixed
     */
    public function trash(User $user, Attendance $attendance)
    {
        return $this->check($user,$attendance);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Attendance  $attendance
     * @return mixed
     */
    public function restore(User $user, Attendance $attendance)
    {
        return $this->check($user,$attendance);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Attendance  $attendance
     * @return mixed
     */
    public function forceDelete(User $user, Attendance $attendance)
    {
        return $this->check($user,$attendance);
    }

    public function check(User $user, Attendance $attendance)
    {
        return $user->id === $attendance->teacher_id;
    }
}
