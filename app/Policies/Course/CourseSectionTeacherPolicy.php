<?php

namespace App\Policies\Course;

use App\Models\V1\Course\CourseSectionTeacher;
use App\Models\V1\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseSectionTeacherPolicy
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
     * @param  \App\CourseSectionTeacher  $courseSectionTeacher
     * @return mixed
     */
    public function view(User $user, CourseSectionTeacher $courseSectionTeacher)
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
     * @param  \App\CourseSectionTeacher  $courseSectionTeacher
     * @return mixed
     */
    public function update(User $user, CourseSectionTeacher $courseSectionTeacher)
    {
        return $this->check($user,$courseSectionTeacher);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\CourseSectionTeacher  $courseSectionTeacher
     * @return mixed
     */
    public function trash(User $user, CourseSectionTeacher $courseSectionTeacher)
    {
        return $this->check($user,$courseSectionTeacher);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\CourseSectionTeacher  $courseSectionTeacher
     * @return mixed
     */
    public function restore(User $user, CourseSectionTeacher $courseSectionTeacher)
    {
        return $this->check($user,$courseSectionTeacher);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\CourseSectionTeacher  $courseSectionTeacher
     * @return mixed
     */
    public function forceDelete(User $user, CourseSectionTeacher $courseSectionTeacher)
    {
        return $this->check($user,$courseSectionTeacher);
    }

    public function check(User $user, CourseSectionTeacher $courseSectionTeacher)
    {
        return $user->id===$courseSectionTeacher->teacher_id;
    }
}
