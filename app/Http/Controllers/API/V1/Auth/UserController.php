<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\V1\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 
 */
class UserController extends Controller
{
	
	public function profile(Request $request)
	{
		$user = User::findOrFail(auth()->user()->id);
		return response()->json($user);
	}
}