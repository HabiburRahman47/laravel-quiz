<?php

namespace App\Policies\Question;

use App\Model\V1\Question\Question;
use App\Model\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
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
     * @param  \App\Question  $question
     * @return mixed
     */
    public function view(User $user, Question $question)
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
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        return $this->check($user,$question);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function trash(User $user, Question $question)
    {
        return $this->check($user,$question);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function restore(User $user, Question $question)
    {
        return $this->check($user,$question);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function forceDelete(User $user, Question $question)
    {
        return $this->check($user,$question);
    }
    public function check(User $user, Question $question)
    {
        return $user->id===$question->created_by_id;
    }
}
