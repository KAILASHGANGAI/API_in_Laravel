<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::with('roles')->get();
        return  UserResource::collection($users);
    }
    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'status' => 'Login Successfuly',
                'access_token' => $token,
                'username' => $user->name
            ]);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',

        ]);
    }

    public function register(UserRequest $req)
    {
        $model = User::create($req->all());
        return $model;
    }
}
