<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignInRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(SignInRequest $request): JsonResponse
    {
        try {
            $email = strtolower($request['email']);
            $password = $request['password'];

            if (!Auth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'error' => 'Invalid credentials!'
                ], 401);
            }

            $user = User::whereId(Auth::user()->id)->with('level')->first();
            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;
            $user->token = $token;

            return response()->json(compact('user'));
        } catch (\Throwable $e) {
            return response()->json($e, 500);
        }
    }
}
