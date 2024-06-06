<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $output = [
            'styles' => [],
            'scripts' => [],
        ];
        
        return view('dashboard', $output);        
    }

}
