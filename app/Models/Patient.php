<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Patient extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'today_date',
        'first_name',
        'last_name',
        'dob',
        'mobile_number',
        'nic',
        'gender',
        'address_lane_1',
        'address_lane_2',
        'city',
    ];
    protected $appends = [
        'age',
        'name',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
     public function getNameAttribute()
    {
        return  $this->first_name . " " . $this->last_name ;
    }

     public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
    
    public function lastAppointment()
    {
        return $this->hasOne(Appointment::class, 'patient_id')->latest();
    }

    public function getEmailAttribute()
    {
        return  $this->user->email ;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'patient_id');
    }
    
}

