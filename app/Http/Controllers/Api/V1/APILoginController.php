<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use JWTFactory;
use Auth;
use JWTAuth;
use Validator;
use Response;

class APILoginController extends Controller
{
    	/**
    	 *
    	 * Login Controller.
    	 * @param $request Request.
    	 * @return $response.
    	 */
	public function login(Request $request) {
	        $validator = Validator::make($request->all(), [
	            'email' => 'required|string|email|max:255',
	            'password'=> 'required'
	        ]);
	        if ($validator->fails()) {
	            return response()->json($validator->errors());
	        }
        	$credentials = $request->only('email', 'password');
	        try {

	            if (! $token = JWTAuth::attempt($credentials)) {
	                return response()->json(['error' => 'invalid_credentials'], 401);
	            }
	        } catch (JWTException $e) {
	            return response()->json(['error' => 'could_not_create_token'], 500);
	        }
            $user = Auth::user();
            $response['token'] = $token;
            $response['user'] = $user;
        	return response()->json($response);
    }

    /**
     *
     * User Details.
     * @param $request Request.
     * @return $response.
     */
    public function userDetails(Request $request) {
    	return auth()->user();
    }
}
