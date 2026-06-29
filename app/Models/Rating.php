<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['patient_id', 'center_id', 'rating', 'comment', 'ip_address', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
