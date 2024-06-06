<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppLoginController extends Controller
{
    public function login() {
        if(Auth::check()) {
            return redirect()->intended('/');
        }

        $data = [
            'styles' => [
                '/assets/app/css/auth/auth.css'
            ],
            'scripts' => [
                '/assets/app/js/auth/auth.js'
            ]
        ];

        return view('app.auth.login', $data);
    }

    public function logoutApp() {
        if(app(AuthService::class)->logout()) {
            return redirect()->intended('/login');
        }
    }

    public function authenticate(AuthRequest $request) {
        return  app(AuthService::class)->login($request);
    }
}
