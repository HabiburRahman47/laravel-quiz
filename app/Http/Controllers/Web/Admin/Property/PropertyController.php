<?php

namespace App\Http\Controllers\Web\Admin\Property;

use App\DataTables\Property\PropertyDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Property\StorePropertyRequest;
use App\Http\Requests\API\V1\Admin\Property\UpdatePropertyRequest;
use App\Models\V1\Property\Property;
use App\Models\V1\Property\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(PropertyDataTable $dataTable)
    {
        $propertyTypes = PropertyType::get();
        return $dataTable->render('admin.properties.index', compact('propertyTypes'));
    }

    public function create()
    {
        $propertyTypes = PropertyType::where('created_by_id', auth()->user()->id)->get();
        $properties = Property::where('created_by_id', auth()->user()->id)->get();
        return view('admin.properties.create', compact('propertyTypes','properties'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $property = new Property();
        $property->fill($request->all());
        $property->created_by_id = $created_by_id;
        $property->save();
        $displayUrl = route('web.admin.properties.show', $property->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' => $property->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::with('propertyType','parent')->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }

    public function edit($id)
    {
        $propertyTypes = PropertyType::where('created_by_id', auth()->user()->id)->get();
        $parentProperties = Property::where('created_by_id', auth()->user()->id)->get();
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property', 'propertyTypes','parentProperties'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->fill($request->all());
        $property->save();
        $displayUrl = route('web.admin.properties.show', $property->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $property->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    //PERMANENT DELETE
    public function destroy($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $property->forceDelete();
        return response()->json("success");
    }

    //soft delete
    public function trash($id)
    {
        $property = Property::find($id);
        $property->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $property->restore();
        return response()->noContent();
    }

//    public function branch()
//    {
//        return view('admin.properties.parent-child');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageParent()
    {
        $properties = Property::where('parent_id', '=', 0)->get();
        $allProperties = Property::pluck('name','id')->all();
        return view('admin.properties.parent-child',compact('properties','allProperties'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addParent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        Property::create($input);
        return back()->with('success', 'New Category added successfully.');
    }

}
