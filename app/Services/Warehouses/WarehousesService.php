<?php 

namespace App\Services\Warehouses;

use App\Enums\StatusEnum;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;

class WarehousesService {
    public function loadWarehousesFromDatatable() {
        try {
            $warehouses = Warehouses::where('store_id', Auth::user()->store_id)->get();

            $data = [];

            foreach ($warehouses as $warehouse) {
                $warehouse->status_label = $warehouse->status == 1 ?
                    '<label class="badge bg-light-success align-middle">Ativo</label>' :
                    '<label class="badge bg-light-danger align-middle">Inativo</label>';

                $data[] = [
                    'id' => $warehouse->id,
                    'description' => $warehouse->description,
                    'address' => $warehouse->address,
                    'status' => $warehouse->status_label,
                ];
            }
            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a lista de estoques.',
            ], 500);
        }
    }

    public function store($request) {
        try {
            $warehouse = new Warehouses();
            $warehouse->store_id = Auth::user()->store_id;
            $warehouse->description = $request->description;
            $warehouse->zipcode = $request->zipcode;
            $warehouse->address = $request->address;
            $warehouse->number = $request->number;
            $warehouse->complement = $request->complement;
            $warehouse->neighborhood = $request->neighborhood;
            $warehouse->city = $request->city;
            $warehouse->state = $request->state;
            $warehouse->status =  StatusEnum::ACTIVE;
            $warehouse->color = $request->color;
            $warehouse->save();

            return response()->json([
                'message' => 'Estoque cadastrado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function update($request) {
        try {
            $warehouse = Warehouses::find($request->id);

            $warehouse->description = $request->description;
            $warehouse->zipcode = $request->zipcode;
            $warehouse->address = $request->address;
            $warehouse->number = $request->number;
            $warehouse->complement = $request->complement;
            $warehouse->neighborhood = $request->neighborhood;
            $warehouse->city = $request->city;
            $warehouse->state = $request->state;
            $warehouse->status = $request->status == 1 ? StatusEnum::ACTIVE : StatusEnum::INACTIVE;
            $warehouse->color = $request->color;
            $warehouse->save();

            return response()->json([
                'message' => 'Estoque atualizado com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível atualizar o estoque.',
            ], 500);
        }
    }

    public function delete($warehouse) {
        try {
            $warehouse->delete();

            return response()->json([
                'message' => 'Estoque excluído com sucesso.',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluir o estoque.',
            ], 500);
        }
    }
}
