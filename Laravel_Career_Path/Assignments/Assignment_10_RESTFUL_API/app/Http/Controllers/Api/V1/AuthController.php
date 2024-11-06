<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(UserRegistrationRequest $request)
    {
        $validated = $request->validated();

        try {
            $createUser = $this->userService->registerUser($validated);
            if ($createUser) {
                return response()->json(['message' => 'User registered successfully'], 201);
            } else {
                return response()->json(['message' => 'Registration failed'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during registration',
                // 'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'API_Key' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
