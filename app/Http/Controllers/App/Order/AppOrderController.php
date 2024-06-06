<?php

namespace App\Http\Controllers\App\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Transactions;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;

class AppOrderController extends Controller
{
    public function index(){
        $output = [
            'styles' => [
                '/assets/app/css/orders/orders.css'
            ],
            'scripts' => [
                '/assets/app/js/orders/orders.js'
            ]
        ];
        
        return view('app.order.index', $output);    

    }

    public function viewOrder(Request $request, $order_number)
    {
        $paymentLink = Transactions::where('order_id', $order_number)->first();

        $output = [
            'paymentLink' => $paymentLink,
            'styles' => [
                '/assets/app/css/orders/orders.css'
            ],
            'scripts' => [
                '/assets/app/js/orders/edit.js'
            ]
        ];

        return view('app.order.order', $output);
    }

    public function listAllOrders(OrderService $orderService){
        return $orderService->listAllOrders();
    }

    public function newOrder(StoreOrderRequest $request, OrderService $orderService){
        return $orderService->newOrder($request->all());
    }

    public function detailsOrder(Request $request, OrderService $orderService){
        return $orderService->detailsOrder($request);
    }

    public function updateClient(StoreOrderRequest $request, OrderService $orderService){
        return $orderService->updateClient($request->all());
    }
}
