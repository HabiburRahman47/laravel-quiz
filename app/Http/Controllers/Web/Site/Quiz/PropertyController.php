<?php

namespace App\Http\Controllers\Web\Site\Quiz;

use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;

class PropertyController extends AdminBaseController
{
    
    public function index($slug)
    {
        $propertyType=PropertyType::where('slug',$slug)->firstOrFail();
        $propertyTypeId=$propertyType->id;
        $properties=Property::where('property_type_id','=',$propertyTypeId)->get();
        return view('site.quizzes.properties',compact('properties'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $property=Property::with('propertyType')->where('slug',$slug)->firstOrFail();
        // return response()->json($property);
        return view('site.quizzes.showProperty',compact('property'));
    }    
}
