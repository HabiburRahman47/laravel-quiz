<?php

namespace App\Http\Controllers\Web\Admin\Property;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Property\StorePropertyRequest;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class PropertyController extends AdminAPIBaseController
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $property = Property::with('propertyType')->latest()->get();
            return DataTables::of($property)
                ->addIndexColumn()
                ->addColumn('full_name', '{{$name}} ({{$private_name}})')
                ->editColumn('visibility', function($property){
                                            if ($property->visibility == 'Private'){
                                            return '<span  class="badge badge-danger">Private</span>';
                                            }else{
                                                return '<span  class="badge badge-primary">Public </span>';
                                            // }else{ return '<span  class="badge badge-danger" > Public </span>';}
                                            } })
                ->addColumn('updated_at','{{ \Carbon\Carbon::parse($updated_at)->toDayDateTimeString() }}')
                ->addColumn('property_type.name',function($property){
                            return '<a href="'. route('property-types.show',$property->type_id) .'">'. $property->propertyType->name .'</a>';})
                ->rawColumns(['property_type'])
                ->addColumn('action', function ($property) {
                    $editUrl = "http://lsapp.test/web/property/edit/" . $property->id;
                    $showUrl = "http://lsapp.test/web/property/show/" . $property->id;

                    $action =  '<a href="'.$showUrl.'" class="btn btn-info"  id=' . $property->id . '>Show</a>
<a href="'.$editUrl.'" class="btn btn-success" id="edit-user" id=' . $property->id . '>Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a  data-id=' . $property->id . ' class="btn btn-danger delete-user">Delete</a>';

                    return $action;
                })
                ->rawColumns(['action','visibility'])
                ->make(true);
        }

        return view('admin.property.index');
    }


    public function create()
    {
        $propertyTypes=DB::table('property_types')->where('created_by_id',auth()->user()->id)->get();
        return  view('Web.Property.create',compact('propertyTypes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {

        $created_by_id = auth()->user()->id;
        $property = new Property();
        $property->fill($request->all());
        $property->created_by_id = $created_by_id;
        $property->save();
        $property->id;
        $propertyTypes=DB::table('property_types')->where('created_by_id',auth()->user()->id)->get();
        //$LastInsertId = $property->id;
        // return back()->with('message','Successfully Created');
       session()->flash('success','Created Successfully , to show');
        //return $this->back(url('web/property/show/'))->with(['rId' => $property->id]);
        return view('admin.property.create',compact('property'),compact('propertyTypes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('id' => $id);

        $property = Property::with('propertyType')->where($where)->first();
         return view('Web.Property.show', compact('property'));
    }

    public function edit($id)
    {
        $propertyTypes= DB::table('property_types')->where('created_by_id',auth()->user()->id)->get();
        $property = Property::findOrFail($id);
        return view('Web.Property.edit', compact('property','propertyTypes'));

    }

    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->fill($request->all());
        $property->save();
        // return new PropertyTypeResource($propertyType);
        // return redirect()->route('web.property.index');
        Session::flash('success','Updated Successfully');
        return back();
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
        $property = Property::findOrFail($id);
        $property->forceDelete();
        return response()->json("success");
    }

    //soft delete
    public function trash($id)
    {
        $property = Property::find($id);
        $property->delete();
        return response()->json($property);
    }


}
