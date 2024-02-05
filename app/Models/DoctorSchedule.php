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
    

    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }


    public function AvailableDays(){
        $days = $this->attributes['available_days'];

        if (count($days) === 7) {
            return 'Daily';
        }

        return implode(', ', $days);
    }

}

