<?php 

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService {
    public function login($request) {
        try {
            $user = User::where('username', $request->username)->first();

            if(!password_verify($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Email ou senha inválidos',
                ], 422);
            }

            Auth::loginUsingId($user->id);
    
            return true;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Tente novamente mais tarde',
            ], 422);
        }
    }

    public function logout() {
        Auth::logout();

        return redirect('/login');
    }

    public function user() {
        return response()->json([
            'user' => auth()->user()
        ], 200);
    }
}