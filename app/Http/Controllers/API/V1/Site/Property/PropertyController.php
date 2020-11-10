<?php

namespace App\Http\Controllers\API\V1\Site\Property;

use App\Http\Controllers\API\V1\Site\AdminAPIBaseController;
use App\Http\Requests\API\V1\Site\Property\StorePropertyRequest;
use App\Http\Requests\API\V1\Site\Property\UpdatePropertyRequest;
use App\Http\Resources\API\V1\Site\Property\PropertyCollection;
use App\Http\Resources\API\V1\Site\Property\PropertyResource;
use App\Models\V1\Property\Property;
use App\Models\V1\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends AdminAPIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PropertyCollection
     */
    public function index()
    {
        $properties = Property::with('propertyType')
            ->applyTrashFilterAble()
            ->applyKeywordSearchAble()
            ->applySortAble()
            ->applyPaginateAble();
        return new PropertyCollection($properties);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyRequest $request
     * @return PropertyResource
     */
    public function store(StorePropertyRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $property = new Property();
        $property->fill($request->all());
        $property->created_by_id = $created_by_id;
        $property->save();
        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return PropertyResource
     */
    public function show($id)
    {
        $property = Property::with('propertyType','departments')->applyTrashFilterAble()->findOrFail($id);
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePropertyRequest $request
     * @param  int $id
     * @return PropertyResource
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->fill($request->all());
        $this->authorize('update', $property);
        $property->save();

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage permanently.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $property);
        $property->forceDelete();
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
        $property = Property::findOrFail($id);
        $this->authorize('trash', $property);
        $property->delete();
        return response()->noContent();
    }

    /**
     * Restore the specified resource.
     *
     * @param  int $id
     * @return PropertyResource
     */
    public function restore($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $this->authorize('restore', $property);
        $property->restore();
        return new PropertyResource($property);
    }
}
