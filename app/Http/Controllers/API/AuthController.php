<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //login - email & password

        //if success, generate token return response json
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = auth()->user()->createToken('API')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'You have successfully login',
                'token' => $token,
                'data' => auth()->user()
            ]);
        }
        else
        {
        //else return response wrong credential
            return response()->json([
                'success' => false,
                'message' => 'Please check your credentials'
            ]);
        }
    }
}
