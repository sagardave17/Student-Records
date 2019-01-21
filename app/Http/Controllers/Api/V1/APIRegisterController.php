<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class APIRegisterController extends Controller {
	
	/**
	 *
	 * Registration with JWT.
	 * @param $request.
	 * @return $response.
	 */
	public function register(Request $request) {
		
	        $validator = Validator::make($request->all(), [
	            'email' => 'required|string|email|max:255|unique:users',
	            'name' => 'required',
	            'password'=> 'required'
	        ]);
	        if ($validator->fails()) {
	            return response()->json($validator->errors());
	        }
	        User::create([
	            'name' => $request->get('name'),
	            'email' => $request->get('email'),
	            'password' => bcrypt($request->get('password')),
	            'role_id' => $request->get('role_id'),
	        ]);
	        $user = User::first();
	        $token = JWTAuth::fromUser($user);        
        	return Response::json(['Message' => 'SuccessfullyRegistration','token' => $token]);
    }
}
