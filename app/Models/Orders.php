<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'order_status',
        'client_document',
        'client_name',
        'client_email',
        'client_phone',
        'client_cep',
        'client_address',
        'client_number',
        'client_complement',
        'client_neighborhood',
        'client_city',
        'client_state',
    ];

    public function orderTransaction()
    {
        return $this->hasOne(OrderTransactions::class, 'order_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProducts::class, 'order_id');
    }
}
