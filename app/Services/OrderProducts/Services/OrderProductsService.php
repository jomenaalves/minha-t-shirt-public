<?php

namespace App\Services\OrderProducts\Services;

use App\Commom\Abstracts\AbstractService;
use App\Services\OrderProducts\Repositories\OrderProductsRepository;

class OrderProductsService extends AbstractService
{
    public function __construct(OrderProductsRepository $repository)
    {
        $this->repository = $repository;
    }
}