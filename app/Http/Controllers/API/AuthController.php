<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Validator;
use App\User;
use Auth;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;

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

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email.', 'status' => true], 201)
            : response()->json(['message' => 'Unable to send reset link', 'status' => false], 401);
    }
}
