<?php

namespace App\Models;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function consultation(){
        return $this->belongsTo(Consultation::class,'consultation_id');
    }
}
