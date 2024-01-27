<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function doctors(){
        return $this->hasMany(Doctor::class,'doctor_schedule_id');
    }
}
