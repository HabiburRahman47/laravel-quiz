<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Models\V1\Category\Category;
use App\Models\V1\Property\Property;
use App\Models\V1\Quiz\Quiz;

class QuizController extends AdminBaseController
{
    
    public function index()
    {
        $categories=Category::get();
        return view('site.quizzes.categories',compact('categories'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        $category=Category::with('quizzes')->findOrFail($categoryId);
        return view('site.quizzes.showCategory',compact('category'));
    }    
    public function quizQuestions($slug)
    {
        $quizQuestions=Quiz::with('questions.choices')->where('slug',$slug)->firstOrFail();
        return view('site.quizzes.showQuestions',compact('quizQuestions'));
    }
}
