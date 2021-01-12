<?php

namespace App\Providers;

use App\Models\V1\Attendance\Attendance;
use App\Models\V1\Category\Category;
use App\Models\V1\Choice\Choice;
use App\Models\V1\Course\Course;
use App\Models\V1\Course\CourseSectionTeacher;
use App\Models\V1\Department\Department;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;
use App\Models\V1\Question\Question;
use App\Models\V1\Question\Question_Quiz;
use App\Models\V1\Quiz\Quiz;
use App\Models\V1\Quiz\QuizResult;
use App\Models\V1\Quiz\QuizSession;
use App\Models\V1\Section\Section;
use App\Models\V1\Student\Student;
use App\Models\V1\UserContact\UserContact;
use App\Policies\Attendance\AttendancePolicy;
use App\Policies\Category\CategoryPolicy;
use App\Policies\Choice\ChoicePolicy;
use App\Policies\Course\CoursePolicy;
use App\Policies\Course\CourseSectionTeacherPolicy;
use App\Policies\Department\DepartmentPolicy;
use App\Policies\Property\PropertyPolicy;
use App\Policies\Property\PropertyTypePolicy;
use App\Policies\Question\QuestionPolicy;
use App\Policies\Quiz\QuizPolicy;
use App\Policies\Quiz\QuizQuestionPolicy;
use App\Policies\Quiz\QuizResultPolicy;
use App\Policies\Quiz\QuizSessionPolicy;
use App\Policies\Section\SectionPolicy;
use App\Policies\Student\StudentPolicy;
use App\Policies\User\UserContactPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
         Property::class=> PropertyPolicy::class,
         PropertyType::class=>PropertyTypePolicy::class,
         Attendance::class=>AttendancePolicy::class,
         Choice::class=>ChoicePolicy::class,
         Course::class=>CoursePolicy::class,
         CourseSectionTeacher::class=>CourseSectionTeacherPolicy::class,
         Department::class=>DepartmentPolicy::class,
         Question::class=>QuestionPolicy::class,
         Quiz::class=>QuizPolicy::class,
         Section::class=>SectionPolicy::class,
         Student::class=>StudentPolicy::class,
         UserContact::class=>UserContactPolicy::class,
         Category::class=>CategoryPolicy::class,
         QuizResult::class=>QuizResultPolicy::class,
         Question_Quiz::class=>QuizQuestionPolicy::class,
         QuizSession::class=>QuizSessionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (app()->environment('local')) {
            Passport::routes(function ($router) {
                $router->forAccessTokens();
            });
        }
    }
}
