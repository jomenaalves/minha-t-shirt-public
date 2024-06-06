<?php

namespace App\Http\Controllers\App\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppProductsController extends Controller
{
    public function products(){
        $output = [
            'styles' => [],
            'scripts' => [
                '/assets/app/js/products/products.js'
            ]
        ];
        
        return view('app.products.products', $output);        
    }
}
