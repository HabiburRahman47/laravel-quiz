<?php

namespace App\Http\Controllers\Web\Admin\Property;

use App\DataTables\Property\PropertyTypesDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Property\StorePropertyTypeRequest;
use App\Http\Requests\API\V1\Admin\Property\UpdatePropertyTypeRequest;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeResource;
use App\Models\V1\Property\PropertyType;

class PropertyTypeController extends AdminBaseController
{

    public function index(PropertyTypesDataTable $dataTable)
    {
        return $dataTable->render('admin.property-types.index');
    }

    public function create()
    {
        return view('admin.property-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyTypeRequest $request
     * @return void
     */
    public function store(StorePropertyTypeRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $propertyType = new PropertyType();
        $propertyType->fill($request->all());
        $propertyType->created_by_id = $created_by_id;
        $propertyType->save();


        $displayUrl = route('web.admin.property-types.show', $propertyType->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$propertyType->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PropertyTypeResource
     */
    public function show($id)
    {
        $propertyType = PropertyType::with('properties')->findOrFail($id);
        $this->authorize('show',$propertyType);
        return view('admin.property-types.show', compact('propertyType'));
    }

    public function edit($id)
    {
        $propertyType = PropertyType::findOrFail($id);
        return view('admin.property-types.edit', compact('propertyType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePropertyTypeRequest $request
     * @param int $id
     * @return PropertyTypeResource
     */
    public function update(UpdatePropertyTypeRequest $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->fill($request->all());
        $this->authorize('update',$propertyType);
        $propertyType->save();
        $displayUrl = route('web.admin.property-types.show', $propertyType->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $propertyType->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $propertyType = PropertyType::withTrashed()->findOrFail($id);
        // $this->authorize('destroy',$propertyType);
        $propertyType->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $propertyType = PropertyType::find($id);
        $this->authorize('trash',$propertyType);
        $propertyType->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$propertyType = PropertyType::withTrashed()->where('id', $id)->restore();
        $propertyType = PropertyType::withTrashed()->findOrFail($id);
        $this->authorize('restore',$propertyType);
        $propertyType->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
