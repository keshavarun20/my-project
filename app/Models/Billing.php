<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'description',
        'rate',
        'qty',
        'subtotal',
        'payment_method',
        'cheque_no',
        'reference_no',
        'total',
        'discount_percent',
        'discount',
        'tax_percent',
        'tax',
        'payable'
    ];


    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}

