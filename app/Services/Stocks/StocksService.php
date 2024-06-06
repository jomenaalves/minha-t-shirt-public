<?php 

namespace App\Services\Stocks;

use App\Enums\StatusEnum;
use App\Models\Products;
use App\Models\{
    ProductsHasWarehouses, Warehouses
};
use Illuminate\Support\Facades\{
    Auth, DB
};

class StocksService {
   public function update($request) {
        try {
            $actionUpdate = match ($request->action) {
                'add' => $this->addStock($request),
                'remove' => $this->removeStock($request),
                'transfer' => $this->transferStock($request),
            };

            return $actionUpdate;

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function addStock($request) {
        try {
            $products = json_decode($request->products, true);

            foreach ($products as $product) {
                $productWarehouse = ProductsHasWarehouses::where('product_id', $product['product_id'])
                    ->where('warehouse_id', $request->warehouse_id)
                    ->first();
                if ($productWarehouse) {
                    $productWarehouse->qty += $product['qty'];
                    $productWarehouse->save();
                } else {
                    $productWarehouse = new ProductsHasWarehouses();
                    $productWarehouse->product_id = $product['product_id'];
                    $productWarehouse->warehouse_id = $request->warehouse_id;
                    $productWarehouse->qty = $product['qty'];
                    $productWarehouse->save();
                }
            }

            return response()->json([
                'message' => 'Estoque atualizado com sucesso.',
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function removeStock($request) {
        try {
            $products = json_decode($request->products, true);
            
            foreach ($products as $product) {
                $productWarehouse = ProductsHasWarehouses::where('product_id', $product['product_id'])
                    ->where('warehouse_id', $request->warehouse_id)
                    ->first();
                if ($productWarehouse) {
                    $productWarehouse->qty -= $product['qty'];
                    $productWarehouse->save();
                } else {
                    return response()->json([
                        'message' => 'Produto não encontrado no estoque.',
                    ], 404);
                }
            }

            return response()->json([
                'message' => 'Estoque atualizado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function transferStock($request) {
        try {
            DB::beginTransaction();

            $products = json_decode($request->products);

            foreach ($products as $product) {
                $productWarehouseSub = ProductsHasWarehouses::where('product_id', $product->product_id)
                    ->where('warehouse_id', $request->warehouse_id)
                    ->first();

                if ($productWarehouseSub) {
                    $productWarehouseSub->qty -= $product->qty;
                    $productWarehouseSub->save();
                } else {
                    return response()->json([
                        'message' => 'Produto não encontrado no estoque.',
                    ], 404);
                }

                $productWarehouseSum = ProductsHasWarehouses::where('product_id', $product->product_id)
                    ->where('warehouse_id', $request->stock_id)
                    ->first();

                if ($productWarehouseSum) {
                    $productWarehouseSum->qty += $product->qty;
                    $productWarehouseSum->save();
                } else {
                    $productWarehouseSum = new ProductsHasWarehouses();
                    $productWarehouseSum->product_id = $product->product_id;
                    $productWarehouseSum->warehouse_id = $product->stock_id;
                    $productWarehouseSum->qty = $product->qty;
                    $productWarehouseSum->save();
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Estoque atualizado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getProductsStock($id) {
        try {
            $products = Products::where('status', StatusEnum::ACTIVE)
                ->select('products.id', 'products.name')
                ->get();

            return response()->json($products);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao buscar os produtos do estoque.',
            ], 500);
        }
    }

    public function getWarehouses() {
        try {
            $warehouses = Warehouses::where('status', StatusEnum::ACTIVE)
                ->where('store_id', Auth::user()->store_id)
                ->select('id', 'description')
                ->get();

            return response()->json($warehouses);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao buscar os estoques.',
            ], 500);
        }
    }
}
