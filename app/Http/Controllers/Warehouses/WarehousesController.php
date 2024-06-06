<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Classes\Integrations\CepPromisse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouses\{
    UpdateWarehousesRequest, WarehousesRequest
};
use App\Models\{
    Warehouses, Products
};
use App\Services\Warehouses\WarehousesService;
use App\Enums\StatusEnum;

class WarehousesController extends Controller
{
    public function index()
    {
        $output = [
            'styles' => [
                '/assets/css/plugins/style.css',
            ],
            'scripts' => [
                '/assets/js/warehouses/index.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ],
        ];

        return view('warehouses.index', $output);
    }

    public function store(WarehousesRequest $request, WarehousesService $warehouseService)
    {
        return $warehouseService->store($request);
    }

    public function show(string $id)
    {
        $warehouse = Warehouses::find($id);

        $warehouse->status_label = $warehouse->status == 1 ?
            '<label class="badge bg-light-success align-middle">Ativo</label>' :
            '<label class="badge bg-light-danger align-middle">Inativo</label>';

        $statistic_warehouse = Warehouses::selectRaw('
                (SELECT COUNT(*) FROM products_has_warehouses WHERE warehouse_id = warehouses.id) as products,
                (SELECT COUNT(*) FROM products_has_warehouses WHERE warehouse_id = warehouses.id AND qty > 0) as products_positive,
                (SELECT COUNT(*) FROM products_has_warehouses WHERE warehouse_id = warehouses.id AND qty < 0) as products_negative
            ')
            ->where('id', $id)
            ->first();

        $products_warehouse = Products::where('status', StatusEnum::ACTIVE)
            ->rightJoin('products_has_warehouses', function ($join) use ($id) {
                $join->on('products.id', '=', 'products_has_warehouses.product_id')
                    ->where('products_has_warehouses.warehouse_id', $id);
            })
            ->select('products.id', 'products.name', 'products_has_warehouses.qty')
            ->get();

        $output = [
            'styles' => [
                '/assets/css/plugins/style.css',
                '/assets/css/warehouses/style.css',
            ],
            'scripts' => [
                '/assets/js/warehouses/edit.js',
                '/assets/js/plugins/jquery.dataTables.min.js',
                '/assets/js/plugins/dataTables.bootstrap5.min.js',
                '/assets/js/plugins/dataTables.buttons.min.js',
                '/assets/js/plugins/dataTables.colReorder.min.js',
                '/assets/js/plugins/dataTables.rowReorder.min.js',
                '/assets/js/plugins/simple-datatables.js',
            ],
            'warehouse' => $warehouse,
            'statistic_warehouse' => $statistic_warehouse,
            'products_warehouse' => $products_warehouse,
        ];

        return view('warehouses.edit', $output);
    }

    public function update(UpdateWarehousesRequest $request, WarehousesService $warehouseService)
    {
        return $warehouseService->update($request);
    }

    public function destroy(string $id)
    {
        $warehouse = Warehouses::find($id);

        $warehouse->delete();

        return response()->json([
            'message' => 'Estoque excluído com sucesso.',
        ]);
    }

    public function loadWarehousesFromDatatable(WarehousesService $stocksService)
    {
        return $stocksService->loadWarehousesFromDatatable();
    }

    public function getAddressByCep($zipcode, CepPromisse $cepPromisse)
    {
        $promise = $cepPromisse->getAddressByCep($zipcode);

        $address = $promise->wait();

        return $address;
    }
}
