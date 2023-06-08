<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
            ]
        ]);
    }

    public function logout()
    {
        //auth()->user()->tokens()->delete(); //remove all user tokens

        auth()->user()->currentAccessToken()->delete(); //remove only request token

        return response()
            ->json([], 204);
    }

    public function infos()
    {
        return response()->json(
            [
                'user' => auth()->user()->name,
                'email' => auth()->user()->email
            ]
        );
    }
}
