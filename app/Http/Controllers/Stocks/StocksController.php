<?php

namespace App\Http\Controllers\Stocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stocks\StocksRequest;
use App\Services\Stocks\StocksService;

class StocksController extends Controller
{
    public function getProductsStock(int $id, StocksService $stocksService)
    {
        return $stocksService->getProductsStock($id);
    }

    public function getWarehouses(StocksService $stocksService)
    {
        return $stocksService->getWarehouses();
    }

    public function update(StocksRequest $request, StocksService $stocksService)
    {
        return $stocksService->update($request);
    }
}
