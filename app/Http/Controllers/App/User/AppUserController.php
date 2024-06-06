<?php

namespace App\Http\Controllers\App\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    public function user() {
        return app(UserService::class)->user();
    }
}
