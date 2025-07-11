<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Account created successful',
            'data' => $user->fresh(),
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        if(!Auth::attempt($request->only('email','password')))
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials'
        ], 401);

        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Logged in successful',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(){
        $currentUser = Auth::user();
        $currentUser->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logged out successful',
        ], 200);
    }

}

