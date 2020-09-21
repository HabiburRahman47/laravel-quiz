<?php

namespace App\Http\Controllers\API\V1\Admin\User;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Requests\API\V1\Admin\User\StoreUserContactRequest;
use App\Http\Requests\API\V1\Admin\User\UpdateUserContactRequest;
use App\Http\Resources\API\V1\Admin\User\UserContactCollection;
use App\Http\Resources\API\V1\Admin\User\UserContactResource;
use App\Models\V1\UserContact\UserContact;
use Illuminate\Http\Request;

class UserContactController extends AdminAPIBaseController
{

    public function index(Request $request)
    {
        $userContacts = UserContact::applyTrashFilterAble()
                    ->applyKeywordSearchAble()
                    ->applySortAble()
                    ->applyPaginateAble();
        return new UserContactCollection($userContacts);
    }

    public function store(StoreUserContactRequest $request)
     {
    //     $this->makeFakeLogin();
        $created_by_id = auth()->user()->id;
        // logic to store a student record goes here
        $userContact = new UserContact();
        $userContact->fill($request->all());
        $userContact->created_by = $created_by_id;
        $userContact->save();
        return new UserContactResource($userContact);
    }


    public function show($userContactId)
    {
        // logic to get a student record goes here

        $userContact = UserContact::findOrFail($userContactId);
        return new UserContactResource($userContact);

    }


    public function update(UpdateUserContactRequest $request, $userContactId)
    {
            $created_by_id = auth()->user()->id;
        // logic to update a student record goes here
            $userContact = UserContact::findOrFail($userContactId);
            $userContact->fill($request->all());
            $userContact->created_by = $created_by_id;
            $this->authorize('update',$userContact);
            $userContact->save();
            return new UserContactResource($userContact);
    }

    public function trash($userContactId)
    {
        $userContact=UserContact::findOrFail($userContactId);
        $this->authorize('trash',$userContact);
        $userContact->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($userContactId)
    {
        $userContact=UserContact::withTrashed()->findOrFail($userContactId);
        $this->authorize('restore',$userContact);
        $userContact->restore();
        return new UserContactResource($userContact);
    }

    public function destroy($userContactId){
        $userContact=UserContact::withTrashed()->findOrFail($userContactId);
        $this->authorize('forceDelete',$userContact);
        $userContact->forceDelete();
        return response()->noContent();
    }


    //Method for Searching
    public function search()
    {
        $search_key = request()->get('name');
        $userContacts = UserContact::where('name', 'LIKE', '%' . $search_key . '%')->get();
        return new UserContactResource($userContacts);
    }
    //Sorting code for the users
    public function filtering()
    {
        $search_key = request()->get('visibility');
        if ($search_key == '1') {
            $userContacts = UserContact::where('visibility', '1');
        } else {
            $userContacts = UserContact::where('visibility', '0');
        }
        return new UserContactResource($userContacts);
    }
}

