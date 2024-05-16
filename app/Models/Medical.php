<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'management_plan',
        'treatment',
        'medication',
        'medical_history',
        'surgical_history',
        'food',
        'drugs',
        'plaster',
        'family_history',
        'consanguineous_marriage',
        'occupation',
        'monthly_income',
        'nearest_hospital',
        'water_source',
        'general_sign',
        'abdominal',
        'cardiovascular_system',
        'respiratory_system',
        'height',
        'weight',
        'bmi',
        'temperature',
        'diagnosis',
        'presenting_complaint',
    ];

    protected $casts = [
        'presenting_complaint' => 'array',
        'management_plan' => 'array',
    ];
    
   

    protected function presenting_complaint(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function management_plan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    

    
    
}
