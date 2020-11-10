<?php

namespace App\Http\Controllers\API\V1\Site\Property;

use App\Models\V1\Property\Property;
use App\Models\V1\User\User;

class UserPropertyController
{

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
}