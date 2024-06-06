<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $output = [
            'styles' => [
                '/assets/css/dashboard/dashboard.css',
            ],
            'scripts' => [
                '/assets/js/dashboard/dashboard.js',
            ],
        ];
        
        return view('dashboard', $output);        
    }

}
