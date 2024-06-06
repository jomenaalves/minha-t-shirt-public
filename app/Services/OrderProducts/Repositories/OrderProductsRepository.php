<?php 

namespace App\Services\OrderProducts\Repositories;

use App\Commom\Abstracts\AbstractRepository;
use App\Models\OrderProducts;

class OrderProductsRepository extends AbstractRepository
{
    public function __construct(OrderProducts $model)
    {
       $this->model = $model;
    }
    
}