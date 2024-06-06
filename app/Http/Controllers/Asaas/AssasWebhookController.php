<?php

namespace App\Http\Controllers\Asaas;

use App\Enums\Orders\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\FailsPayments;
use App\Models\Orders;
use Illuminate\Http\Request;

class AssasWebhookController extends Controller
{
    public function payment(Request $request) {
        $webhook = $request->all();

        if($webhook['event'] == 'PAYMENT_RECEIVED'){
            
            if($webhook['payment']['status'] !== 'RECEIVED'){
                return;
            }

            try {
                $getOrderOfPayment = Orders::where('paymentID', $webhook['payment']['paymentLink'])->first();
               
                if(!$getOrderOfPayment){
                    return;
                }
            
                $getOrderOfPayment->update([
                    'status' => OrderStatusEnum::COMPLETED
                ]);

                return 'Pedido pago com sucesso!';
             
            } catch (\Throwable $th) {
        
                FailsPayments::create([
                    'paymentID' => $webhook['payment']['paymentID'],
                    'error' => $th->getMessage(),
                ]);
        
                return 'Falha atualizar status do pedido.';
            }
        }
    }
}
