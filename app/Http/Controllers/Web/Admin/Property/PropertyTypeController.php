<?php

namespace App\Http\Controllers\Web\Admin\Property;

use App\DataTables\PropertyTypesDataTable;
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

    public function index(PropertyTypesDataTable $dataTable)
    {
        return $dataTable->render('admin.property-types.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index2(Request $request)
    {
//        flash()->warning('Failed');
//        flash()->success('Successfully done')->important();
//        flash()->overlay('Modal Message', 'Modal Title')->error();
        if ($request->ajax()) {
            $propertyType = PropertyType::latest()->get();
            return DataTables::of($propertyType)
                ->addIndexColumn()
                ->addColumn('action', function ($propertyType) {
                    $id = $propertyType->id;
                    $editUrl = route('web.admin.property-types.edit', $id);
                    $showUrl = route('web.admin.property-types.show', $id);
                    $action = view('core.dashboard.layout.partials.datatable.action', compact('id', 'showUrl', 'editUrl'));
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.property-types.index2');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyTypeRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $propertyType = new PropertyType();
        $propertyType->fill($request->all());
        $propertyType->created_by_id = $created_by_id;
        $propertyType->save();
        //return response()->json($propertyType);
        //return new PropertyTypeResource($propertyType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propertyType = PropertyType::with('properties.events.eventType')->findOrFail($id);
        return new PropertyTypeResource($propertyType);
        //$propertyType=PropertyType::with('properties.owner')->findOrFail($id);
        //return new PropertyTypeResource($propertyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropertyTypeRequest $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->fill($request->all());
        $propertyType->save();
        return new PropertyTypeResource($propertyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    //PERMANENT DELETE
    public function destroy($id)
    {
        //$propertyType=PropertyType::onlyTrashed()->where('id',$id)->forceDelete();
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    //soft delete
    public function trash($id)
    {
        $propertyType = PropertyType::find($id);
        $propertyType->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($id)
    {
        $propertyType = PropertyType::withTrashed()->where('id', $id)->restore();
        return response('SUCCESSFULLY RESTORED');
    }


    //searching anything
    public function search(Request $request)
    {
        $propertyTypeName = $request->get('name');
        $propertyTypes = PropertyType::where('name', 'LIKE', '%' . $propertyTypeName . '%')->orderBy('id')->paginate(2);
        return response($propertyTypes);
    }
}
