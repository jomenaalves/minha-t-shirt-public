<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $table = 'cashier';

    protected $fillable = [
        'date',
        'note',
        'sold',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(CashierProducts::class, 'cashier_id');
    }

    public function getQuantityProductsAttribute()
    {
        return $this->products()->sum('quantity');
    }
    
    public function payments()
    {
        return $this->hasMany(CashierPayments::class, 'cashier_id');
    }
   
    public function withdrawal()
    {
        return $this->hasMany(CashierWithdrawal::class, 'cashier_id');
    }

    public function getTotalWithdrawalAttribute()
    {
        return $this->withdrawal()->sum('value');
    }
}
