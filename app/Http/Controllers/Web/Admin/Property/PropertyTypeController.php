<?php

namespace App\Http\Controllers\Web\Admin\Property;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\Property\StorePropertyTypeRequest;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeCollection;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeResource;
use App\Models\V1\Property\PropertyType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $propertyType = PropertyType::latest()->get();
            return DataTables::of($propertyType)
                ->addIndexColumn()
                ->addColumn('action', function ($propertyType) {
                    $editUrl = route('web.admin.property-types.edit',$propertyType->id);

                    $showUrl = "http://lsapp.test/property-types/show/" . $propertyType->id;
                    $action =  '<a href="'.$showUrl.'" class="btn btn-info"  id=' . $propertyType->id . '>Show</a>
<a href="' . $editUrl . '" class="btn btn-success" id="edit-user" id=' . $propertyType->id . '>Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a data-id=' . $propertyType->id . ' class="btn btn-danger delete-user">Delete</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.property-types.index');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyTypeRequest $request)
    {
        //$this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        // $property=PropertyType::create($request->all());
        $propertyType= new PropertyType();
        $propertyType->fill($request->all());
        $propertyType->created_by_id = $created_by_id;
        $propertyType->save();
        //return response()->json($propertyType);
        //return new PropertyTypeResource($propertyType);
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
    public function update(StorePropertyTypeRequest $request, $id)
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
