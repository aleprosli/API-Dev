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
        return response([
            'success' => true,
            'message' => 'Successfully fetch all users',
            'data' => $users
        ]);
    }
}
