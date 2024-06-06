<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierPayments extends Model
{
    use HasFactory;

    protected $table = 'cashier_payments';

    protected $fillable = [
        'cashier_id',
        'method',
        'value',
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'cashier_id');
    }
}
