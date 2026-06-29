<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Center extends Model
{
    protected $guarded = [];


    public function scopeFilter(Builder $query, $search = null, $city_id = null, $category_id = null)
    {
        if ($search) {
            $query->where('center_name', 'like', '%' . $search . '%');
        }
        if ($city_id) {
            $query->where('city_id', $city_id);
        }
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function isLicenseApproved(): bool
    {
        return $this->license_status === 'approved';
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function site()
    {
        return $this->hasOne(Site::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function avgRating(): float
{
    return round($this->ratings()->avg('rating') ?? 0, 1);
}

public function ratingsCount(): int
{
    return $this->ratings()->count();
}
}
