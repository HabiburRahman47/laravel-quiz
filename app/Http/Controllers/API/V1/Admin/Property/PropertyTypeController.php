<?php

namespace App\Http\Controllers\API\V1\Admin\Property;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Property\StorePropertyTypeRequest;
use App\Http\Requests\API\V1\Admin\Property\UpdatePropertyTypeRequest;
use App\Http\Resources\API\V1\Admin\Property\PropertyResource;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeCollection;
use App\Http\Resources\API\V1\Admin\Property\PropertyTypeResource;
use App\Models\V1\Property\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends AdminAPIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return PropertyTypeCollection
     */
    public function index(Request $request)
    {
        $propertyTypes = PropertyType::with('properties')
            ->applyTrashFilterAble()
            ->applyKeywordSearchAble()
            ->applySortAble()
            ->applyPaginateAble();

        return new PropertyTypeCollection($propertyTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyTypeRequest $request
     * @return PropertyTypeResource
     */
    public function store(StorePropertyTypeRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $propertyType = new PropertyType();
        $propertyType->fill($request->all());
        $propertyType->created_by_id = $created_by_id;
        $propertyType->save();
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return PropertyTypeResource
     */
    public function show($id)
    {
        $propertyType = PropertyType::with('properties')->applyTrashFilterAble()->findOrFail($id);
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePropertyTypeRequest $request
     * @param  int $id
     * @return PropertyTypeResource
     */
    public function update(UpdatePropertyTypeRequest $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->fill($request->all());
        $this->authorize('update',$propertyType);
        $propertyType->save();
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Remove the specified resource from storage permanently.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertyType = PropertyType::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$propertyType);
        $propertyType->forceDelete();
        return response()->noContent();
    }

    /**
     * Trash the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $this->authorize('trash',$propertyType);
        $propertyType->delete();
        return response()->noContent();
    }

    /**
     * Restore the specified resource.
     *
     * @param  int $id
     * @return PropertyTypeResource
     */
    public function restore($id)
    {
        $propertyType = PropertyType::withTrashed()->findOrFail($id);
        $this->authorize('restore',$propertyType);
        $propertyType->restore();
        return new PropertyTypeResource($propertyType);
    }
}
