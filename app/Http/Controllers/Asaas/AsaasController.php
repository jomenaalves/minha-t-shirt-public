<?php

namespace App\Http\Controllers\Asaas;

use App\Enums\Orders\OrderStatusEnum;
use App\Http\Classes\Integrations\Assas\GeneratePaymentLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\Asass\GetPaymentLinkRequest;
use App\Models\Orders;
use App\Models\Transactions;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;

class AsaasController extends Controller
{
    public function getPaymentLink(GetPaymentLinkRequest $request, ) {
        try {
            $order = (new OrderService())->getOrderById($request->input('order_id'));
    
            $generatePaymentLink = new GeneratePaymentLink();
            $paymentLink = $generatePaymentLink->generatePaymentLink($order['cpf'], $order['amount']);
            $url = $paymentLink['url'];
            $paymentID = $paymentLink['id'];
            
            // change to service
            $transaction = Transactions::create([
                'order_id' => $order['id'],
                'paymentLink' => $url,
                'paymentID' => $paymentID
            ]);

            $mOrder = Orders::where('id', $order['id'])->first();
            $mOrder->update([
                'order_status' => OrderStatusEnum::WAITING
            ]);

            return response()->json([
                'paymentLink' => $url,
            ]);
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }
}
