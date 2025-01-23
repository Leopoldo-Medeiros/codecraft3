<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request): JsonResponse
    {
        // Validate incoming request data
        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure this matches your requirements
        ]);

        // Create a new user with a hashed password
        $user = User::create([
            'nome_completo' => $validated['nome_completo'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password correctly
        ]);

        return response()->json([
            'message' => 'User created successfully.',
            'user' => [
                'name' => $user->nome_completo,
            ],
        ], 201);
    }

    /**
     * Handle user login.
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => [
                'name' => $user->nome_completo,
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): JsonResponse
    {
        // Delete the current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
