<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Models\V1\Property\Property;

class SchoolController extends AdminBaseController
{
    
    public function index()
    {
        $schools=Property::get();
        return view('site.quizzes.schools',compact('schools'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school=Property::with('propertyType')->findOrFail($id);
        return view('site.quizzes.showSchools',compact('school'));
    }    
}
