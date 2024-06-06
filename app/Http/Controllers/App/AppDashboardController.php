<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppDashboardController extends Controller
{
    public function dashboard(){
        $output = [
            'styles' => [],
            'scripts' => [],
        ];
        
        return view('app.dashboard', $output);        
    }
}
