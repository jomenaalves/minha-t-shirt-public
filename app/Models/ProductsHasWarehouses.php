<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsHasWarehouses extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'products_has_warehouses';
}
