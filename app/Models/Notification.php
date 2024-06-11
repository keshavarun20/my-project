<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'title',
        'message',
        'doctor_message',

    ];

    public function patient()
    {
        return $this->hasOne(Patient::class, 'patient_id');
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'doctor_id');
    }
}
