<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try{
            // Validate the value...
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // find user by email
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Invalid email or password'
                ], 'Authentication Failed', 400);
            }

            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new Exception('Invalid email or password');
            }

            // generate token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'user' => $user
            ], 'Authenticated');


        }catch(Exception $err){
            return ResponseFormatter::error('Authentication Failed', $err->getMessage());
        }
    }

    public function register(Request $request)
    {
        try{
            // Validate the value...
            $validated = $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // create user
            User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // find user by email
            $user = User::where('email', $request->email)->first();

            // generate token
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'user' => $user
            ], 'Authenticated');

        }catch(Exception $err){
            return ResponseFormatter::error('Authentication Failed', $err->getMessage());
        }
    }
}
