<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\{
    ProductsRequest, UpdateProductsRequest
};
use App\Models\Products;
use App\Services\Products\ProductsService;

class ProductsController extends Controller
{
    public function index()
    {
        $output = [
            'styles' => [
                '/assets/css/plugins/style.css',
            ],
            'scripts' => [
                '/assets/js/products/index.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ],
        ];

        return view('products.index', $output);
    }

    public function store(ProductsRequest $request, ProductsService $productsService)
    {
        return $productsService->store($request);
    }

    public function show($id)
    {
        $product = Products::find($id);

        $product->status_label = $product->status == 'active' ?
            '<label class="badge bg-light-success align-middle">Ativo</label>' :
            '<label class="badge bg-light-danger align-middle">Inativo</label>';
    
        $output = [
            'styles' => [
                '/assets/css/plugins/style.css',
            ],
            'scripts' => [
                '/assets/js/products/edit.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ],
            'product' => $product,
        ];

        return view('products.edit', $output);
    }

    public function update(UpdateProductsRequest $request, ProductsService $productsService)
    {
        return $productsService->update($request);
    }
  
    public function loadProductsFromDatatable(ProductsService $productsService)
    {
        return $productsService->loadProductsFromDatatable();
    }

}
