<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        if(Auth::check()) {
            return redirect()->intended('/');
        }

        $data = [
            'scripts' => [
                '/assets/js/auth/auth.js'
            ]
        ];

        return view('auth.login', $data);
    }

    public function logout(AuthService $authService) {
        if($authService->logout()) {
            return redirect()->intended('/login');
        }
    }

    public function auth(AuthRequest $request, AuthService $authService) {
        return $authService->login($request);
    }
}
