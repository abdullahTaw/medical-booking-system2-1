<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'address',
        'city',
        'state',
        'country',
        'medical_history',
        'blood_type',
        'allergies',
        'center_id',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
