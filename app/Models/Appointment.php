<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'first_name',
        'last_name',
        'age',
        'mobile_number',
        'date',
        'token_number',
        'reference_number'

    ];

    protected $appends = [
        'name',
        'doctorName'
    ];

    public function getNameAttribute()
    {
    return  $this->first_name . " " . $this->last_name ;
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id');
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function getDoctorNameAttribute(){
        if($this->doctor()->exists())
            return $this->doctor->name;
        else
            return null;
    }
}
