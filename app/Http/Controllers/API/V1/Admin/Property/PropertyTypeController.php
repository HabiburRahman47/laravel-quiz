<?php

namespace App\Http\Controllers\API\V1\Admin\Property;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Property\PropertyTypeRequest;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeCollection;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeResource;
use App\Models\V1\Property\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends AdminAPIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyTypes=PropertyType::all();
        return new PropertyTypeCollection($propertyTypes);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyTypeRequest $request)
    {
        //$this->makeFakeLogin();
        $created_by_id = auth()->user()->id;

        // $property=PropertyType::create($request->all());
        $propertyType= new PropertyType();
        $propertyType->fill($request->all());
        $propertyType->created_by_id = $created_by_id;
        $propertyType->save();
        //return response()->json($propertyType);
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propertyType=PropertyType::with('properties.events.eventType')->findOrFail($id);
        return new PropertyTypeResource($propertyType);
        //$propertyType=PropertyType::with('properties.owner')->findOrFail($id);
        //return new PropertyTypeResource($propertyType);
    }

    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyTypeRequest $request, $id)
    {
        $propertyType=PropertyType::findOrFail($id);
        $propertyType->fill($request->all());
        $propertyType->save();
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //PERMANENT DELETE
    public function destroy($id)
    {
        //$propertyType=PropertyType::onlyTrashed()->where('id',$id)->forceDelete();
        $propertyType=PropertyType::findOrFail($id);
        $propertyType->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    //soft delete
    public function trash($id)
    {
        $propertyType=PropertyType::find($id);
        $propertyType->delete();
        return response()->noContent();
    }

        //restore data
    public function restore($id)
    {
        $propertyType=PropertyType::withTrashed()->where('id',$id)->restore();
        return response('SUCCESSFULLY RESTORED');
    }



    //searching anything
    public function search(Request $request)
    {
        $propertyTypeName=$request->get('name');
        $propertyTypes=PropertyType::where('name','LIKE','%'.$propertyTypeName.'%')->orderBy('id')->paginate(2);
        return response($propertyTypes);
    }
}
