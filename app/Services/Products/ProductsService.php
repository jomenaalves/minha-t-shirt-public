<?php 

namespace App\Services\Products;


use App\Enums\StatusEnum;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class ProductsService {
    public function loadProductsFromDatatable() {
        try {
            $products = Products::where('store_id', Auth::user()->store_id)->get();

            $data = [];

            foreach ($products as $product) {
                $data[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'barcode' => $product->barcode,
                    'system_code' => $product->system_code,
                ];
            }
            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a lista de produtos.',
            ], 500);
        }
    }

    public function store($request) {
        try {
            $product = new Products();
            $product->store_id = Auth::user()->store_id;
            $product->name = $request->name;
            $product->barcode = $request->barcode;
            $product->system_code = $request->system_code;
            $product->status = StatusEnum::ACTIVE;
            $product->save();

            return response()->json([
                'message' => 'Produto cadastrado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function update($request) {
        try {
            $product = Products::find($request->id);

            $product->store_id = Auth::user()->store_id;
            $product->name = $request->name;
            $product->barcode = $request->barcode;
            $product->system_code = $request->system_code;
            $product->status = $request->status ? StatusEnum::ACTIVE : StatusEnum::INACTIVE;
            $product->save();

            return response()->json([
                'message' => 'Produto atualizado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível atualizar o produto.',
            ], 500);
        }
    }

    public function delete($product) {
        try {
            $product->delete();

            return response()->json([
                'message' => 'Produto excluído com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluir o produto.',
            ], 500);
        }
    }
}
