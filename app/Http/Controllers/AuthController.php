<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Throwable;

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

            $user = User::whereId(Auth::user()->id)->first();
            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;
            $user->token = $token;

            return response()->json(compact('user'));
        } catch (Throwable $e) {
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
        } catch (Throwable $e) {
            return response()->json($e, 500);
        }
    }

    public function signOut()
    {
        try {
            $user = User::whereId(Auth::user()->id)->first();
            $user->tokens()->delete();
            return response()->noContent();
        } catch (Throwable $e) {
            return response()->json($e, 500);
        }
    }
}
