<?php

namespace App\Http\Controllers\V1\Auth;

use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return ResponseHelper::success('Correct', 200, ['token' => $token]);
        }
        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function me()
    {
        $user = auth()->user();
        return ResponseHelper::success('Correct' , 200 , new UserResource($user));
    }

    public function register(RegisterRequest $request)
    {
        $newUser = UserHelper::createUser($request->name,$request->username,$request->password);
        return ResponseHelper::success('User created' , 201 , new UserResource($newUser));
    }
}
