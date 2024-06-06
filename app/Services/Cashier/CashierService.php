<?php 

namespace App\Services\Cashier;

use App\Models\Cashier;
use App\Models\CashierPayments;
use App\Models\CashierProducts;
use App\Models\CashierWithdrawal;
use App\Models\Products;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CashierService{
    
    public function loadCashiersFromDatatable() {
        try {
            $cashiers = Cashier::with('payments', 'withdrawal')->get();
            $stores = Stores::all();
            $products = Products::all();

            $data = [];
            foreach ($cashiers as $cashier) {

                //Valor da retirada
                $withdrawal = $cashier->withdrawal->where('cashier_id', $cashier->id)->first();
                $totalValue = $cashier->sold - ($withdrawal ? $withdrawal->value : 0);

                //Pagamentos
                $payments_methods = $cashier->payments->where('cashier_id', $cashier->id)->toArray();
                $payment = $payments_methods ? $this->paymentsMethods($payments_methods) : 'Nenhum pagamento encontrado.';            

                $data[] = [
                    'id' => $cashier->id,
                    'date' => date('d/m/Y', strtotime($cashier->created_at)),
                    'sold' => "R$ ".number_format($cashier->sold, 2, ',', ''),
                    'out' => "R$ ".number_format(($withdrawal ? $withdrawal->value : 0), 2, ',', ''),
                    'totalCashier' => "R$ ".number_format($totalValue, 2, ',', ''),
                    'paymentMethods' => $payment,
                    'quantityProducts' => $cashier->quantity_products,
                    'status' => $cashier->status, 
                    'products' => $cashier->products->toArray(),         
                    'stores' => $stores,         
                ];
            }
            $allDatas = [
                'data' => $data,
                'products' => $products,
                'stores' => $stores,
            ];

            return response()->json($allDatas);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a lista de caixa.'
            ], 500);
        }
    } 
    
    public function paymentsMethods($payments) {
        $html = ''; 
    
        foreach ($payments as $payment => $value) {
            $method = '';

            switch ($value['method']) {
                case 'pix':
                    $method = 'Pix';
                    break;
                case 'debit_card':
                    $method = 'Cartão de Dédito';
                    break;
                case 'credit_card':
                    $method = 'Cartão de Crédito';
                    break;
                case 'transfer':
                    $method = 'Transferência (TED/DOC)';
                    break;
                case 'money':
                    $method = 'Dinheiro';
                    break;
                case 'others':
                    $method = 'Outros';
                    break;
                default:
                    $method = 'Método Desconhecido';
                    break;
            }
            $html .= "<strong>{$method}:</strong> R$ " . number_format($value['value'], 2, ',', '') . "<br>";
        } 

        return $html;
    }
    
    public function create($request){

        try {
            DB::beginTransaction();
        
            $cashier = new Cashier();
            $cashier->date = $request->input('date_accounting');
            $cashier->note = $request->input('note');
            $cashier->sold = $request->input('products_total');
            $cashier->status = 0;
            $cashier->save();

            $indexesProducts = [];

            foreach ($request->all() as $key => $value) {
                if (preg_match('/product-(\d+)/', $key, $matches)) {
                    $indexesProducts[] = $matches[1]; 
                }
            }            
            foreach ($indexesProducts as $index) {
                $product = $request->input("product-$index");
                $stock = $request->input("stock-$index");
                $quantity = $request->input("quantity-$index");
                $price = $request->input("price-$index");

                $cashierProduct = new CashierProducts();
                $cashierProduct->cashier_id = $cashier->id;
                $cashierProduct->product_id = $product;
                $cashierProduct->store_id = $stock;
                $cashierProduct->quantity = $quantity;
                $cashierProduct->price = $price;
                $cashierProduct->save();
            }
        
            $indexesPayments = [];

            foreach ($request->all() as $key => $value) {
                if (preg_match('/methods-(\d+)/', $key, $matches)) {
                    $indexesPayments[] = $matches[1]; 
                }
            }
            
            foreach ($indexesPayments as $index) {
                $method = $request->input("methods-$index");
                $value = $request->input("value-$index");
            
                if ($method && $value) {
                    $cashierPayment = new CashierPayments();
                    $cashierPayment->cashier_id = $cashier->id;
                    $cashierPayment->method = $method;
                    $cashierPayment->value = $value;
                    $cashierPayment->save();
                }
            }
        
            DB::commit();
            return response()->json([
                'message' => 'Caixa cadastrado com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível cadastrar o caixa.',
                'error' => $th->getMessage(),
            ], 500);
        }
        
    }

    public function details($request){
        
        try {
            $cashier = Cashier::where('id', $request->id)->with('products.product', 'products.store','payments', 'withdrawal')
                       ->withSum('payments', 'value') ->first();
            $payment =  $cashier->payments ? $this->paymentsMethods($cashier->payments) : 'Nenhum pagamento encontrado.'; 
            $selectStores = Stores::all();
            $selectProducts = Products::all();
 
            $allProducts = [];
            $productsCount = 0;
            $valueTotalProducts = 0;

            foreach ($cashier->products as $cashierProduct) {
                $allProducts[] = [
                    'cashier_product' => $cashierProduct->id,
                    'product_id' => $cashierProduct->product_id,
                    'product_name' => $cashierProduct->product->name,
                    'store_id' => $cashierProduct->store_id,
                    'store_name' => $cashierProduct->store->name,
                    'quantity' => $cashierProduct->quantity,
                    'price' => "R$ ".number_format($cashierProduct->price, 2, ',', ''),
                    'total' => "R$ ".number_format($cashierProduct->price * $cashierProduct->quantity, 2, ',', ''),
                ];
                $productsCount ++;
                $valueTotalProducts += $cashierProduct->price * $cashierProduct->quantity;
            }
            
            $allWithdrawal = [];
            foreach ($cashier->withdrawal as $cashierWithdrawal) {
                $allWithdrawal[] = [
                    'cashier_withdrawal' => $cashierWithdrawal->id,
                    'date'=> date('d/m/Y H:m', strtotime($cashierWithdrawal->created_at)),
                    'value' => "R$ ".number_format($cashierWithdrawal->value, 2, ',', ''),
                    'note' => $cashierWithdrawal->note,
                ];
            }

            $data = [
                'id' => $cashier->id,
                'date' => $cashier->date,
                'note' => $cashier->note,
                'sold' =>  "R$ ".number_format($cashier->sold, 2, ',', ''),
                'status' => $cashier->status,
                'total_withdrawal' => "R$ ".number_format($cashier->total_withdrawal, 2, ',', ''),
                'quantity_products' => $productsCount,
                'total_cashier' => "R$ ".number_format($cashier->sold - $cashier->total_withdrawal, 2, ',', ''),    
                'value_total_products' => number_format($valueTotalProducts, 2, ',', ''),  
                'value_total_payments' => number_format($cashier->payments_sum_value, 2, ',', ''), 
                'withdrawal' => $allWithdrawal,
                'payment' => $payment,
                'products' => $allProducts,
                'select_products' => $selectProducts,
                'select_stores' => $selectStores,
            ];
        
            return response()->json($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível carregar a os detalhes do caixa',
            ], 500);
        }

    }

    public function addProducts($request){

        try {
            DB::beginTransaction();

            $indexProducts = 1;
            $valueTotalProducts = 0;

            while ($request->has("product-$indexProducts")) {
                $product = $request->input("product-$indexProducts");
                $stock = $request->input("stock-$indexProducts");
                $quantity = $request->input("quantity-$indexProducts");
                $price = $request->input("price-$indexProducts");
                $valueTotalProducts += $price * $quantity;

                $cashierProduct = new CashierProducts();
                $cashierProduct->cashier_id = $request->cashier_id;
                $cashierProduct->product_id = $product;
                $cashierProduct->store_id = $stock;
                $cashierProduct->quantity = $quantity;
                $cashierProduct->price = $price;
                $cashierProduct->save();

                $indexProducts++;
            }

            $cashier = Cashier::find($request->cashier_id);
            if ($cashier) {
                $cashier->sold += $valueTotalProducts; 
                $cashier->save(); 
            }
        
            DB::commit();
            return response()->json([
                'message' => 'Produtos adicionados com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível adicionar os produtos.',
                'error' => $th->getMessage(),
            ], 500);
        }
        
    }

    public function updateNote($request){

        try {
            DB::beginTransaction();

            $cashier = Cashier::find($request->cashier_id);
            $cashier->note = $request->input('note');
            $cashier->save();            
        
            DB::commit();
            return response()->json([
                'message' => 'Observação atualizada com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar a observação.',
                'error' => $th->getMessage(),
            ], 500);
        }      

    }
    
    public function close($request){

        try {
            DB::beginTransaction();

            $cashier = Cashier::find($request->cashier_id);
            $cashier->status = 1;
            $cashier->save();            
        
            DB::commit();
            return response()->json([
                'message' => 'Caixa fechado com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível fechar o caixa.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }
   
    public function withdrawal($request){

        try {
            DB::beginTransaction();

            $cashier = new CashierWithdrawal();
            $cashier->cashier_id = $request->input("cashier_id");
            $cashier->value += $request->input("value_withdrawal");
            $cashier->note = $request->input("description_withdrawal");
            $cashier->save();            
        
            DB::commit();
            return response()->json([
                'message' => 'Retirada adicionada com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível adicionar a retirada.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }

    public function loadCashierProduct($request){

        try {
            DB::beginTransaction();

            $cashierProduct = CashierProducts::where('id',$request->cashier_product_id)->with('product','store')->first();
           
        
            $data = [
                'id' => $cashierProduct->id,
                'product' => $cashierProduct->product->name,
                'store' => $cashierProduct->store->name,
                'quantity' =>$cashierProduct->quantity,   
            ];   

            return response()->json($data);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível encontrar o produto.'
            ], 500);
        }      
    }

    public function removeItem($request){

        try {
            DB::beginTransaction();

            $cashierProduct = CashierProducts::where('id', $request->cashier_product_id)->first();

            $rebateValue = $cashierProduct->quantity * $cashierProduct->price;

            $cashier = Cashier::find($cashierProduct->cashier_id);
            $cashier->sold -= $rebateValue;
            $cashier->save();  
            
            $cashierProduct->delete();
        
            DB::commit();
            return response()->json([
                'message' => 'Item removido com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível remover o item.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }
    
    public function updateItem($request){

        try {
            DB::beginTransaction();

            $cashierProduct = CashierProducts::where('id', $request->update_cashier_product_id)->first();

            $currentValue = $cashierProduct->quantity * $cashierProduct->price;
            $newValue = $request->update_new_quantity * $cashierProduct->price;

            if ($currentValue > $newValue) {
                $difference = $currentValue - $newValue;
                $cashier = Cashier::find($cashierProduct->cashier_id);
                $cashier->sold -= $difference;
                $cashier->save(); 
            } else {
                $difference = $newValue - $currentValue;
                $cashier = Cashier::find($cashierProduct->cashier_id);
                $cashier->sold += $difference;
                $cashier->save();
            }

            $cashierProduct->quantity = $request->input('update_new_quantity');                      
            $cashierProduct->save();
        
            DB::commit();
            return response()->json([
                'message' => 'Item atualizado com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar o item.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }

    public function loadCashierPayment($request){

        try {
            DB::beginTransaction();

            $cashierPayment = CashierPayments::where('cashier_id', $request->id)->get();
           
            $data = [];

            foreach ($cashierPayment as $payment) {                
                $data[] = [
                    'id' => $payment->id,
                    'method' => $payment->method,
                    'value' => number_format($payment->value, 2, '.', ''),   
                ];                   
            }

            return response()->json($data);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível encontrar o pagemento.'
            ], 500);
        }      
    }

    public function updatePayments($request){

        try {
            DB::beginTransaction();

            $cashierPayments = CashierPayments::where('cashier_id', $request->cashier_id)->get();
            foreach ($cashierPayments as $payment) {
                $payment->delete();
            }

            $indexes = [];

            foreach ($request->all() as $key => $value) {
                if (preg_match('/methods-(\d+)/', $key, $matches)) {
                    $indexes[] = $matches[1]; 
                }
            }
            
            foreach ($indexes as $index) {
                $method = $request->input("methods-$index");
                $value = $request->input("value-$index");
            
                if ($method && $value) {
                    $cashierPayment = new CashierPayments();
                    $cashierPayment->cashier_id = $request->cashier_id;
                    $cashierPayment->method = $method;
                    $cashierPayment->value = $value;
                    $cashierPayment->save();
                }
            }
        
            DB::commit();
            return response()->json([
                'message' => 'Pagamento atualizado com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível atualizar o pagamento.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }

    public function openCashier($request){

        try {
            DB::beginTransaction();

            $masterKey = env('MASTER_KEY');

            if($request->master_password != $masterKey) {
                return response()->json([
                    'message' => 'Senha inválida',
                ], 422);
            }

            $cashier = Cashier::find($request->cashier_id);
            $cashier->status = 0;
            $cashier->save();            
        
            DB::commit();
            return response()->json([
                'message' => 'Caixa aberto com sucesso!',
            ], 200);
        
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Não foi possível abrir o caixa.',
                'error' => $th->getMessage(),
            ], 500);
        }      
    }
    
    

   
}