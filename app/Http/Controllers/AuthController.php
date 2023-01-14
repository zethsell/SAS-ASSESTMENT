<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signIn(SignInRequest $request): JsonResponse
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

    public function signUp(SignUpRequest $request): JsonResponse
    {
        try {
            $user = new User;
            $user->name = $request['name'];
            $user->email = strtolower($request['email']);
            $user->password = Hash::make($request['password']);
            $user->save();

            return response()->json(compact('user'), 201);

        } catch (\Throwable $e) {
            return response()->json($e, 500);
        }
    }
}
