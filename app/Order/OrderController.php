<?php

namespace App\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('app.order.order');
    }

    public function viewOrder()
    {
        return view('app.order.order');
    }

    public function newOrder(StoreOrderRequest $request, OrderService $orderService)
    {
        return $orderService->newOrder($request->all());
    }
}
