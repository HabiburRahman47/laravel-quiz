<?php

namespace App\Policies\Quiz;

use App\Model\V1\Quiz\Quiz;
use App\Model\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
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
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function view(User $user, Quiz $quiz)
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
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function update(User $user, Quiz $quiz)
    {
        return $this->check($user,$quiz);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function trash(User $user, Quiz $quiz)
    {
        return $this->check($user,$quiz);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function restore(User $user, Quiz $quiz)
    {
        return $this->check($user,$quiz);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function forceDelete(User $user, Quiz $quiz)
    {
        return $this->check($user,$quiz);
    }
    public function check(User $user, Quiz $quiz)
    {
        return $user->id===$quiz->created_by_id;
    }
}
