<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Models\V1\Category\Category;
use App\Models\V1\Property\Property;

class CategoryController extends AdminBaseController
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
    public function show($slug)
    {
        $category=Category::with('quizzes')->where('slug',$slug)->firstOrFail();
        // dd($category);
        // return response()->json($category);
        return view('site.quizzes.showCategory',compact('category'));
    }    
    public function categoryQuiz($slug)
    {
        $categoryQuizzes=Category::with('quizzes')->where('slug',$slug)->firstOrFail();
        //return response()->json($categoryQuizzes);
        return view('site.quizzes.showCategoryQuizzes',compact('categoryQuizzes'));
    }
}
