<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'nic',
        'date',
        'name',
        'mobile_number',
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

    public function billings()
    {
        return $this->hasMany(Billing::class, 'payment_id');
    }
}
