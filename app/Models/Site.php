<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
