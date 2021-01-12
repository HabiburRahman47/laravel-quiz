<?php

namespace App\Policies\Quiz;

use App\Models\V1\Question\Question_Quiz;
use App\Models\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuizQuestionPolicy
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
    public function view(User $user, Question_Quiz $quizQuestion)
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
    public function update(User $user, Question_Quiz $quizQuestion)
    {
        return $this->check($user,$quizQuestion);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function trash(User $user, Question_Quiz $quizQuestion)
    {
        return $this->check($user,$quizQuestion);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function restore(User $user, Question_Quiz $quizQuestion)
    {
        return $this->check($user,$quizQuestion);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function forceDelete(User $user, Question_Quiz $quizQuestion)
    {
        return $this->check($user,$quizQuestion);
    }
    public function check(User $user, Question_Quiz $quizQuestion)
    {
        return $user->id===$quizQuestion->created_by_id;
    }
}
