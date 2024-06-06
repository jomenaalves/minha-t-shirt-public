<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailsPayments extends Model
{
    use HasFactory;
    protected $table = 'fails_payments';
    protected $fillable = [
        'paymentID',
        'error',
    ];

    
}
