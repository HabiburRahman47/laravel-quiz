<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::name('web.site.')->namespace('Web\Site\Quiz')->group(function () {
       //Home page
        Route::get('/','HomeController@index')->name('homepage');
        Route::get('/property-types','PropertyTypeController@index')->name('property.types');
        Route::get('/property-types/{slug}/properties','PropertyController@index')->name('properties.index');
        Route::get('properties/{slug}','PropertyController@show')->name('property.show');

        Route::get('/categories','CategoryController@index')->name('category.index');
        Route::get('/categories/{slug}','CategoryController@show')->name('category.show');
        Route::get('/category/{slug}/quizzes','CategoryController@categoryQuiz')->name('category.quiz');
        Route::get('quizzes/{slug}/sessions/start','QuizSessionController@create')->name('quizSession');
        Route::get('/quiz/{slug}/questions','QuizController@quizQuestions')->name('quizQuestions');
        Route::post('quiz-session-ans/{sessionId}/questions/choices/submit','QuizSessionAnsController@store')->name('quizSubmit');
        //Session-Incomplete
        Route::post('quiz-session-ans/{sessionId}/questions/choices/save','QuizSessionAnsController@incompleteSession')->name('quiz.incomplete');
        //Session-Finish
        Route::post('quiz-results/finish/{sessionId}','QuizResultController@store')->name('quiz.finish');
        Route::get('quiz-results/quiz-session/{sessionId}','QuizResultController@show')->name('quiz.result');
        //Previous history
        Route::get('quiz-session/previous-history','QuizSessionController@index')->name('quiz.history');
        //Display Incomplete Quiz
        Route::get('quiz-session/{sessionId}/incomplete-quiz','QuizSessionController@displayIncompleteQuiz')->name('incomplete.quiz.show');
        //Generate PDF of Quiz Result
        Route::get('quiz-session/{sessionId}/quiz-result/pdf-generation','QuizResultController@pdfGeneration')->name('quiz.result.sheet');

});


Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth', 'get.menu']], function () {
     
    Route::get('/', function () {
        return view('admin.dashboard');


    });
    Route::get('/test', function () {
        return view('admin.notifications.modals');
    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Property')->group(function () {
        //property_type
        Route::patch('property-types/{id}/trash', 'PropertyTypeController@trash')->name('property-types.trash');
        Route::patch('property-types/{id}/restore', 'PropertyTypeController@restore')->name('property-types.restore');
        Route::resource('property-types', 'PropertyTypeController');
        Route::post('property-types/{id}','PropertyTypeController@update')->name('property-types.update.all');
        //property
        Route::get('properties/branch','PropertyController@manageParent')->name('properties.branch');
        Route::patch('properties/{id}/trash', 'PropertyController@trash')->name('properties.trash');
        Route::patch('properties/{id}/restore', 'PropertyController@restore')->name('properties.restore');
        Route::Resource('properties', 'PropertyController');
        Route::post('properties/{id}','PropertyController@update')->name('properties.update.all');

    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Topic')->group(function () {
        //topic type
        Route::patch('topic-types/{id}/trash', 'TopicTypeController@trash')->name('topic-types.trash');
        Route::patch('topic-types/{id}/restore', 'TopicTypeController@restore')->name('topic-types.restore');
        Route::resource('topic-types', 'TopicTypeController');
        Route::post('topic-types/{id}','TopicTypeController@update')->name('topic-types.update.all');
        //topic
        Route::patch('topics/{id}/trash', 'TopicController@trash')->name('topics.trash');
        Route::patch('topics/{id}/restore', 'TopicController@restore')->name('topics.restore');
        Route::resource('topics', 'TopicController');
        Route::post('topics/{id}','TopicController@update')->name('topics.update.all');


    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Department')->group(function () {
        //department
        Route::patch('departments/{id}/trash', 'DepartmentController@trash')->name('departments.trash');
        Route::patch('departments/{id}/restore', 'DepartmentController@restore')->name('departments.restore');
        Route::resource('departments', 'DepartmentController');
        Route::post('departments/{id}','DepartmentController@update')->name('departments.update.all');
    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Section')->group(function () {
        //section
        Route::patch('sections/{id}/trash', 'SectionController@trash')->name('sections.trash');
        Route::patch('sections/{id}/restore', 'SectionController@restore')->name('sections.restore');
        Route::resource('sections', 'SectionController');
        Route::post('sections/{id}','SectionController@update')->name('sections.update.all');
        //section-course
        Route::patch('section-courses/{id}/trash', 'SectionCourseController@trash')->name('section-courses.trash');
        Route::patch('section-courses/{id}/restore', 'SectionCourseController@restore')->name('section-courses.restore');
        Route::resource('section-courses', 'SectionCourseController');
        Route::post('section-courses/{id}','SectionCourseController@update')->name('section-courses.update.all');
       
    });
     Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Course')->group(function () {
        //course
        Route::patch('courses/{id}/trash', 'CourseController@trash')->name('courses.trash');
        Route::patch('courses/{id}/restore', 'CourseController@restore')->name('courses.restore');
        Route::resource('courses', 'CourseController');
        Route::post('courses/{id}','CourseController@update')->name('courses.update.all');
         //course-section-teacher
        Route::patch('course-section-teachers/{id}/trash', 'CourseSectionTeacherController@trash')->name('course-section-teachers.trash');
        Route::patch('course-section-teachers/{id}/restore', 'CourseSectionTeacherController@restore')->name('course-section-teachers.restore');
        Route::resource('course-section-teachers', 'CourseSectionTeacherController');
        Route::post('course-section-teachers/{id}','CourseSectionTeacherController@update')->name('course-section-teachers.update.all');
    });
    //student
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Student')->group(function () {
        //student
        Route::patch('students/{id}/trash','StudentController@trash')->name('students.trash');
        Route::patch('students/{id}/restore','StudentController@restore')->name('students.restore');
        Route::resource('students','StudentController');
        Route::post('students/{id}','StudentController@update')->name('students.update.all');
    });
     Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Attendance')->group(function () {
        //Attendance
        Route::patch('attendances/{id}/trash','AttendanceController@trash')->name('attendances.trash');
        Route::patch('attendances/{id}/restore','AttendanceController@restore')->name('attendances.restore');
        Route::resource('attendances','AttendanceController');
        Route::post('attendances/{id}','AttendanceController@update')->name('attendances.update.all');
    });
   Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Quiz')->group(function () {
        //quiz
        Route::patch('quizzes/{id}/trash','QuizController@trash')->name('quizzes.trash');
        Route::patch('quizzes/{id}/restore','QuizController@restore')->name('quizzes.restore');
        Route::resource('quizzes','QuizController');
        Route::post('quizzes/{id}','QuizController@update')->name('quizzes.update.all');
        //quiz-question
        Route::patch('quiz-questions/{id}/trash','QuizQuestionController@trash')->name('quiz-questions.trash');
        Route::patch('quiz-questions/{id}/restore','QuizQuestionController@restore')->name('quiz-questions.restore');
        Route::resource('quiz-questions','QuizQuestionController');
        Route::post('quiz-questions/{id}','QuizQuestionController@update')->name('quiz-questions.update.all');
        //quiz-result
        Route::patch('quiz-results/{id}/trash','QuizResultController@trash')->name('quiz-results.trash');
        Route::patch('quiz-results/{id}/restore','QuizResultController@restore')->name('quiz-results.restore');
        Route::resource('quiz-results','QuizResultController');
        Route::post('quiz-results/{id}','QuizResultController@update')->name('quiz-results.update.all');
        //quiz-session
        Route::patch('quiz-sessions/{id}/trash','QuizSessionController@trash')->name('quiz-sessions.trash');
        Route::patch('quiz-sessions/{id}/restore','QuizSessionController@restore')->name('quiz-sessions.restore');
        Route::resource('quiz-sessions','QuizSessionController');
        Route::post('quiz-sessions/{id}','QuizSessionController@update')->name('quiz-sessions.update.all');
        //quiz-session-answer
        Route::patch('quiz-session-answers/{id}/trash','QuizSessionAnswerController@trash')->name('quiz-session-answers.trash');
        Route::patch('quiz-session-answers/{id}/restore','QuizSessionAnswerController@restore')->name('quiz-session-answers.restore');
        Route::resource('quiz-session-answers','QuizSessionAnswerController');
        Route::post('quiz-session-answers/{id}','QuizSessionAnswerController@update')->name('quiz-session-answers.update.all');



        
    });
    Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Category')->group(function () {
        //category
        Route::patch('categories/{id}/trash','CategoryController@trash')->name('categories.trash');
        Route::patch('categories/{id}/restore','CategoryController@restore')->name('categories.restore');
        Route::resource('categories','CategoryController');
        Route::post('categories/{id}','CategoryController@update')->name('categories.update.all');
    });
     Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Question')->group(function () {
        //question
        Route::patch('questions/{id}/trash','QuestionController@trash')->name('questions.trash');
        Route::patch('questions/{id}/restore','QuestionController@restore')->name('questions.restore');
        Route::resource('questions','QuestionController');
        Route::post('questions/{id}','QuestionController@update')->name('questions.update.all');
          //Question-Choice
        Route::patch('question-choices/{id}/trash','QuestionChoiceController@trash')->name('question-choices.trash');
        Route::patch('question-choices/{id}/restore','QuestionChoiceController@restore')->name('question-choices.restore');
        Route::Resource('question-choices','QuestionChoiceController');
        Route::post('question-choices/{id}','QuestionChoiceController@update')->name('question-choices.update.all');
    });
     Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Choice')->group(function () {
        //Choice
        Route::patch('choices/{id}/trash','ChoiceController@trash')->name('choices.trash');
        Route::patch('choices/{id}/restore','ChoiceController@restore')->name('choices.restore');
        Route::resource('choices','ChoiceController');
        Route::post('choices/{id}','ChoiceController@update')->name('choices.update.all');
    });
     Route::name('web.admin.')->prefix("web/admin")->namespace('Web\Admin\Card')->group(function () {
        //Card
        Route::patch('cards/{id}/trash','CardController@trash')->name('cards.trash');
        Route::patch('cards/{id}/restore','CardController@restore')->name('cards.restore');
        Route::resource('cards','CardController');
        Route::post('cards/{id}','CardController@update')->name('cards.update.all');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/property-branch', function () {

    return  view('admin.properties.categoryTreeview');
});
