<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'order_id',
        'paymentID',
        'paymentLink',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
