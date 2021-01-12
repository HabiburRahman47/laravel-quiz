<?php

namespace App\Policies\Quiz;

use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuizSessionPolicy
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
    public function view(User $user, QuizSession $quizSession)
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
    public function update(User $user, QuizSession $quizSession)
    {
        return $this->check($user,$quizSession);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function trash(User $user, QuizSession $quizSession)
    {
        return $this->check($user,$quizSession);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function restore(User $user, QuizSession $quizSession)
    {
        return $this->check($user,$quizSession);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function forceDelete(User $user, QuizSession $quizSession)
    {
        return $this->check($user,$quizSession);
    }
    public function check(User $user, QuizSession $quizSession)
    {
        return $user->id===$quizSession->created_by_id;
    }
}
