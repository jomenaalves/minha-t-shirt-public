<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierProducts extends Model
{
    use HasFactory;

    protected $table = 'cashier_products';

    protected $fillable = [
        'cashier_id',
        'product_id',
        'store_id',
        'quantity',
        'price',
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'cashier_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }
}
