<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransactions extends Model
{
    use HasFactory;

    protected $table = 'order_transactions';
    
    protected $fillable = [
        'order_id',
        'discount',
        'total_freight',
        'amount',
        'payment_method',
    ];

}
