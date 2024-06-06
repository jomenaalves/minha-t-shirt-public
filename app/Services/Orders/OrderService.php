<?php 

namespace App\Services\Orders;

use App\Enums\Orders\OrderStatusEnum;
use App\Models\Orders;
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
        
        $orders = Orders::with('orderProducts')->get();

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
     
        $orders = Orders::where('id', $request->id)->with('orderProducts.product')->get();

        return response()->json($orders, 201);
    }

    public function updateClient($data)
    {
        DB::beginTransaction();
        try {
            $order = Orders::where('id', $data['id'])->first();
            $order->client_document = $this->sanitizeCpfCnpj($data['document']);
            $order->client_register = $this->sanitizeRG($data['register']);
            $order->client_corporate_reason = $data['corporate_reason'];
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
}