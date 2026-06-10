<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'center_id',
        'patient_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    // علاقة مع المريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // علاقة مع الخدمة
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // FIX: أضفنا علاقة center() — كانت مفقودة رغم وجود center_id في الجدول
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
