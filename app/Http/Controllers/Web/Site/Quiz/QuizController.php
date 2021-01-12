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
    public function show($id)
    {
        $category=Category::with('quizzes')->findOrFail($id);
        // dd($category);
        // return response($category);
        return view('site.quizzes.showCategory',compact('category'));
    }    
    public function quizQuestions($id)
    {
        $quizQuestions=Quiz::with('questions.choices')->findOrFail($id);
        // return response()->json($quizQuestions);
        return view('site.quizzes.showQuestions',compact('quizQuestions'));
    }
}
