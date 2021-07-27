<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        //query all users from DB using Model User.php
        $users = \App\Models\User::all();
        
        //return to json
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch all users',
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'min:5',
            'email' => 'required|unique:users',
            'password' => 'min:5'
        ]);
        //store to DB using User Model
        //name,email,password
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //return success

        return response()->json([
            'success' => true,
            'message' => 'Successfully store users',
            'data' => $users
        ]);
    }
}
