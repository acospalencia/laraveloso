<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {

            //throw $th;

            $request->validate([
                'name' => 'required|string|max:255|unique:users|alpha|min:8|regex:/^[A-Za-z]+$/',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'status' => 201
            ], 201);
        } catch (\Exception $error) {

            return response()->json([
                'message' => 'error registering user',
                'error' => $error->getMessage(),
                'status' => 400
            ], 400);
        }
    }

    public function login(Request $request)
    {

        // token de autenticacion = 1|nYDfwefy3mOkJHK3HDTUWpO8QocNobGIt8EnAyyg6fd1e8ea

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = $request->user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'status' => 200
            ], 200);
        }
    }
}
