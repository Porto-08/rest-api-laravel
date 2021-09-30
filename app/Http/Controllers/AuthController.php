<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $passport = $request->all(['email', 'password']);



        $token = auth('api')->attempt($passport);

        if($token) {
            return [
                'success' => true,
                'message' => 'User authenticated successfully',
                'data' => $token,
            ];
        } else  {
            return [
                'success' => true,
                'message' => 'Email or Password incorrect!',
                'data' => [],
            ];
        }

        return '$token;';
    }

    public function logout() {
        return 'logout';
    }

    public function refresh() {
        return 'refresh';
    }

    public function me() {
        return 'me';
    }
}
