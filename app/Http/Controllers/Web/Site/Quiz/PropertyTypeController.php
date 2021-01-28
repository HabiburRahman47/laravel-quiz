<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;

class PropertyTypeController extends AdminBaseController
{
    
    public function index()
    {
        $created_by_id = auth()->user()->id;
        $propertyTypes=PropertyType::where('created_by_id','=',$created_by_id)->get();
        // return response()->json($propertyTypes);
        return view('site.quizzes.propertyTypes',compact('propertyTypes'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $school=Property::with('propertyType')->where('slug',$slug)->firstOrFail();
        return response()->json($school);
        return view('site.quizzes.showSchools',compact('school'));
    }    
}
