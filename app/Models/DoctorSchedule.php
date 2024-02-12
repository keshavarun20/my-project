<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DoctorSchedule extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'doctor_id',
        'consultation_id',
        'daily_available',
        'available_days',
        'time',
    ];
    

    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    //  function getTimeAttribute($value)
    // {
    //     return Carbon::createFromFormat('H:i', $value)->format('g:i A');
    // }
}

