<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Center;
use App\Models\Category;
use App\Models\Country;
use App\Models\City;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_centers'    => Center::count(),
            'approved_centers' => Center::where('license_status', 'approved')->count(),
            'pending_centers'  => Center::where('license_status', 'pending')->count(),
            'rejected_centers' => Center::where('license_status', 'rejected')->count(),

            'total_patients'   => User::where('role', 'patient')->count(),
            'total_users'      => User::count(),

            'total_categories' => Category::count(),
            'total_countries'  => Country::count(),
            'total_cities'     => City::count(),

            'total_appointments'   => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'scheduled')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
