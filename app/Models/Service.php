<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    // FIX: أضفنا كل العلاقات — كانت Service فارغة تماماً من العلاقات

    // علاقة مع المركز
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    // علاقة مع المواعيد
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // علاقة مع الطلبات الخارجية
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
