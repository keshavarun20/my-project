<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'mobile_number',
        'nic',
        'gender',
        'address_lane_1',
        'address_lane_2',
        'city',
        'consultation_id',
        'slmc_no',
        'base_hospital',
        'specialty',

    ];
    protected $appends = [
        'name'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function consultation(){
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function doctor_schedules(){
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function getNameAttribute()
    {
        // dd(1);
    return "Dr. " . $this->first_name . " " . $this->last_name ;
    }

}
