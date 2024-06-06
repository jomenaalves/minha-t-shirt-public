<?php 

namespace App\Services\Orders;

use App\Enums\Orders\OrderStatusEnum;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\OrderTransactions;
use App\Models\Products;
use App\Traits\Common;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    use Common;

    public function newOrder($data)
    {
        DB::beginTransaction();
        try {
            $order = Orders::create([
                'order_number' => fake()->unique()->randomNumber(8),
                'order_status' => OrderStatusEnum::OPEN,
                'client_document' => $data['document'],
                'client_corporate_reason' => $data['corporate-reason'],
                'client_name' => $data['name'],
                'client_email' => $data['email'],
                'client_phone' => $data['phone']
            ]);
            
            DB::commit();
            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function listAllOrders(){
        
        $orders = Orders::with('orderProducts')->orderBy('created_at', 'desc')->get();

        $data = [];

        foreach ($orders as $order) {
            $totalValue = 0; 
            foreach ($order->orderProducts as $product) {
                $productTotal = $product->price * $product->quantity;
                $totalValue += $productTotal;
            }
            $order['total_value'] = $totalValue;

            $data[] = [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'client' => $order->client_name,
                'total' => $order->total_value,
                'status' => $order->order_status,
                'user' => Auth::user()->name,
            ];            
        }
        return response()->json($data, 201);
    }

    public function detailsOrder($request){
     
        $orders = Orders::where('id', $request->id)->with('orderProducts.product', 'orderTransaction')->get();

        return response()->json($orders, 201);
    }
   
    public function allProducts(){
     
        $products = Products::get();

        return response()->json($products, 201);
    }

    public function updateClient($data)
    {
        DB::beginTransaction();
        try {
            $order = Orders::where('id', $data['id'])->first();
            $order->client_document = $this->sanitizeCpfCnpj($data['document']);
            $order->client_register = $this->sanitizeRG($data['register']);
            $order->client_name = $data['name'];
            $order->client_email = $data['email'];
            $order->client_phone = $this->sanitizePhone($data['phone']);
            $order->save();           
            
            DB::commit();
            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
    
    public function updateAddress($data)
    {
        DB::beginTransaction();
        try {
            $order = Orders::where('id', $data['id'])->first();
            $order->client_cep = $this->sanitizeZipcode($data['cep']);
            $order->client_address = $data['address'];
            $order->client_number = $data['number'];
            $order->client_complement = $data['complement'];
            $order->client_neighborhood = $data['neighborhood'];
            $order->client_city = $data['city'];
            $order->client_state = $data['state'];
            $order->save();           
            
            DB::commit();
            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
    
    public function updateDiscount($data)
    {
        DB::beginTransaction();
        try {
            $orderTransactions = OrderTransactions::where('id', $data['transaction_id'])->first();
            
            if ($orderTransactions) {

                $orderTransactions->order_id = $data['id'];
                $orderTransactions->discount = $this->sanitizeMoneyToDatabase($data['discount_value']);
                $orderTransactions->total_freight = $this->sanitizeMoneyToDatabase($data['freight']);
                $orderTransactions->amount = $data['amount'];
                $orderTransactions->payment_method = $data['payment-type'];
                $orderTransactions->save();
                
            } else {
                $ordertransaction = OrderTransactions::create([
                    'order_id' => $data['id'],
                    'discount' => $this->sanitizeMoneyToDatabase($data['discount_value']),
                    'total_freight' =>  $this->sanitizeMoneyToDatabase($data['freight']),
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment-type'],
                ]);           
            }

            $order = $ordertransaction ?? $orderTransactions;
            
            DB::commit();
            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    // get order by id 
    public function getOrderById($id)
    {
        $order = Orders::with('orderTransaction')->where('id', $id)->first();
        $amount = 50; // $order?->orderTransaction?->amount;

        if(!$order || !$amount) {
            throw new \Exception('Falha na busca de informações do pedido');
        }

        return [
            'id' => $order->id,
            'cpf' => $order->client_document,
            'amount' => $amount, //$order->orderTransaction->amount
        ];
    }

    public function updateProducts($data)
    {
        DB::beginTransaction();
        try {
            $order = OrderProducts::create([
                'order_id' => $data['id'],
                'product_id' => $data['product_id'],
                'price' => $this->sanitizeMoneyToDatabase($data['price']),
                'quantity' => $data['quantity'],
            ]);
            
            DB::commit();
            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
    
    public function deleteProduct($data)
    {

        DB::beginTransaction();
        try {
           $product = OrderProducts::where('id', $data['id'])->first();
           $product->delete();
            
            DB::commit();
            return response()->json([
                'message' => 'Item deletado com sucesso!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}