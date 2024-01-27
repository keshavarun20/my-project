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

    ];
    // protected $appends = [
    //     'dname'
    // ];

    // protected function availabledays(){
    //     return Attribute::make( 
    //         get: fn ($value) =>json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );

    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function consultation(){
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function doctor_schedule(){
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }


    // public function getNameAttribute()
    // {
    //     // dd(1);
    // return "Dr. " . $this->first_name . " " . $this->last_name . " - " . $this->consultations->name;
    // }

}
