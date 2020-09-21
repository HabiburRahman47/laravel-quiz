<?php

namespace App\Http\Controllers\API\V1\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Admin\User\UserCollection;
use App\Http\Resources\API\V1\Admin\User\UserResource;
use App\Models\V1\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users=User::all();
        return new UserCollection($users);
    }

    public function show($id)
    {
        $user=User::with('propertyTypes.properties')->findOrFail($id);
        return new UserResource($user);
    }

    public function showAnother($id)
    {
        $user=User::with('properties.propertyType')->findOrFail($id);
        return new UserResource($user);

    }

    //return all of user
    public function showAll($id)
    {
        $user=User::with('propertyTypes.properties.events.eventType','topicTypes.topics.events.eventType')->findOrFail($id);
        // $user=User::with('properties.propertyType.events.eventType','topics.topicType.events.eventType')->findOrFail($id);
        return new UserResource($user);
    }


}
