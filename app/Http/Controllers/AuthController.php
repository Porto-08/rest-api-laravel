<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $passport = $request->all(['email', 'password']);

        $token = auth('api')->attempt($passport);

        if ($token) {
            return [
                'success' => true,
                'message' => 'User authenticated successfully',
                'data' => $token,
            ];
        } else {
            return [
                'success' => true,
                'message' => 'Email or Password incorrect!',
                'data' => [],
            ];
        }
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        $token = auth('api')->refresh();

        return [
            'success' => true,
            'message' => 'Token refreshed successfully.',
            'data' => $token,
        ];
    }

    // recuperação dos dados do usuario
    public function me()
    {
        return [
            'success' => true,
            'message' => 'User found successfully.',
            'data' => auth()->user('attributes'),
        ];
    }
}
