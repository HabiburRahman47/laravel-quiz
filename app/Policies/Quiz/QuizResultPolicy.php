<?php

namespace App\Policies\Quiz;

use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuizResultPolicy
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
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function view(User $user, QuizResult $quizResult)
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
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function update(User $user, QuizResult $quizResult)
    {
        return $this->check($user,$quizResult);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function trash(User $user, QuizResult $quizResult)
    {
        return $this->check($user,$quizResult);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function restore(User $user, QuizResult $quizResult)
    {
        return $this->check($user,$quizResult);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function forceDelete(User $user, QuizResult $quizResult)
    {
        return $this->check($user,$quizResult);
    }
    public function check(User $user, QuizResult $quizResult)
    {
        return $user->id===$quizResult->created_by_id;
    }
}
