<?php

namespace App\Http\Controllers\API\V1\Admin\Property;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\Event\EventRequest;
use App\Http\Requests\API\V1\Admin\Property\PropertyRequest;
use App\Http\Resources\API\V1\Admin\Event\EventResource;
use App\Http\Resources\API\V1\Admin\Property\PropertyCollection;
use App\Http\Resources\API\V1\Admin\Property\PropertyResource;
use App\Models\V1\Event\Event;
use App\Models\V1\Property\Property;
use App\Models\V1\User\User;
use Illuminate\Http\Request;

class PropertyController extends AdminAPIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PropertyCollection
     */
    public function index()
    {
        $index = Property::with('propertyType')->get();
        return new PropertyCollection($index);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return PropertyResource
     */
    public function store(PropertyRequest $request)
    {
        //$this->makeFakeLogin();
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
        $property = Property::with('propertyType','events.eventType')->findOrFail($id);
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param  int $id
     * @return PropertyResource
     */
    public function update(PropertyRequest $request, $id)
    {
        $Property = Property::findOrFail($id);
        $Property->fill($request->all());
        $Property->save();

        return new PropertyResource($Property);
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
        //$property = Property::onlyTrashed()->where('id', $id)->forceDelete();
        $property=Property::findOrFail($id);
        $property->forceDelete();
        return response('PERMANENTLY DELETED');
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
        $property = Property::withTrashed()->where('id', $id)->restore();
        return response('SUCCESSFULLY RESTORED');
    }


    //searching anything
    public function search(Request $request)
    {
        $propertyName = $request->get('name');
        $properties = Property::where('name', 'LIKE', '%' . $propertyName . '%')->orderBy('id')->paginate(2);

        return response($properties);
    }

    //pivot table

    public function attachPropertyToUser($propertyId, $userId)
    {
        $property = Property::find($propertyId);
        $user = User::find($userId);
        $property->users()->attach($user, ['permission' => 'manage events']);

        return response('Attachment Successful');
    }

    public function detachPropertyToUser($propertyId, $userId)
    {
        $property = Property::find($propertyId);
        $user = User::find($userId);
        $property->users()->detach($user);

        return response('Detachment Successful');
    }

    //join: property->event
    public function addEvent(EventRequest $request, $propertyId)
    {
        //$this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        $event = new Event();
        $event->fill($request->all());
        $event->created_by_id = $created_by_id;
        $property = Property::findOrFail($propertyId);
        $property->events()->save($event);
        $event->save();
        return new EventResource($event);
    }
}
