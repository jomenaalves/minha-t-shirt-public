<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierWithdrawal extends Model
{
    use HasFactory;

    protected $table = 'cashier_withdrawal';

    protected $fillable = [
        'cashier_id',
        'value',
        'note',
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class, 'cashier_id');
    }
}
