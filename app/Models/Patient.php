<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

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
        'age'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}
