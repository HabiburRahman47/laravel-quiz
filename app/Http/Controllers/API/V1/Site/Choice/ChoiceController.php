<?php

namespace App\Http\Controllers\API\V1\Site\Choice;


use App\Http\Controllers\API\V1\Site\AdminAPIBaseController;
use App\Http\Requests\API\V1\Site\Choice\StoreChoiceRequest;
use App\Http\Requests\API\V1\Site\Choice\UpdateChoiceRequest;
use App\Http\Resources\API\V1\Site\Choice\ChoiceCollection;
use App\Http\Resources\API\V1\Site\Choice\ChoiceResource;
use App\Models\V1\Choice\Choice;
use Illuminate\Http\Request;

class ChoiceController extends AdminAPIBaseController
{
    public function index(Request $request)
    {
        $choices=Choice::applyTrashFilterAble()
            ->applyKeywordSearchAble()
            ->applySortAble()
            ->applyPaginateAble();
        return new ChoiceCollection($choices);
    }



    public function store(StoreChoiceRequest $request)
    {
        // $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        //Create a choice data
        $choice=new choice();
        $choice->fill($request->all());
        $choice->created_by_id=$created_by_id;
        $choice->save();
        return new ChoiceResource($choice);
    }


    public function show($choiceId)
    {
        $choice=choice::findOrFail($choiceId);
        return new ChoiceResource($choice);
    }


    public function update(UpdateChoiceRequest $request,$choiceId)
    {
        $choice=choice::findOrFail($choiceId);
        $choice->fill($request->all());
        $this->authorize('update',$choice);
        $choice->save();
        return new ChoiceResource($choice);
    }

    public function trash($choiceId)
    {
        $choice=Choice::findOrFail($choiceId);
        $this->authorize('update',$choice);
        $choice->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($choiceId)
    {
        $choice=Choice::withTrashed()->findOrFail($choiceId);
        $this->authorize('restore',$choice);
        $choice->restore();
        return new ChoiceResource($choice);
    }

    //PERMANENT DELETE
    public function destroy($choiceId)
    {
        $choice=Choice::withTrashed()->findOrFail($choiceId);
        $this->authorize('forceDelete',$choice);
        $choice->forceDelete();
        return response()->noContent();
    }
}
