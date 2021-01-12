<?php

namespace App\Policies\Question;

use App\Models\V1\Choice\ChoiceQuestion;
use App\Models\V1\Question\Question;
use App\Models\V1\User\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionChoicePolicy
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
     * @param  \App\Question  $question
     * @return mixed
     */
    public function view(User $user, ChoiceQuestion $questionChoice)
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
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(User $user, ChoiceQuestion $questionChoice)
    {
        return $this->check($user,$questionChoice);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function trash(User $user, ChoiceQuestion $questionChoice)
    {
        return $this->check($user,$questionChoice);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function restore(User $user, ChoiceQuestion $questionChoice)
    {
        return $this->check($user,$questionChoice);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\V1\User\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function forceDelete(User $user, ChoiceQuestion $questionChoice)
    {
        return $this->check($user,$questionChoice);
    }
    public function check(User $user, ChoiceQuestion $questionChoice)
    {
        return $user->id===$questionChoice->created_by_id;
    }
}
