<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $center = Auth::user()->center;

        if (!$center) {
            $stats = [
                'total_services'      => 0,
                'total_patients'      => 0,
                'total_appointments'  => 0,
                'pending_appointments'=> 0,
                'completed_appointments' => 0,
                'avg_rating'          => 0,
                'ratings_count'       => 0,
                'license_status'      => 'pending',
            ];
            return view('user.dashboard', compact('stats', 'center'));
        }

        $stats = [
            'total_services'         => $center->services()->count(),
            'total_patients'         => $center->patients()->count(),
            'total_appointments'     => $center->appointments()->count(),
            'pending_appointments'   => $center->appointments()->where('status', 'scheduled')->count(),
            'completed_appointments' => $center->appointments()->where('status', 'completed')->count(),
            'avg_rating'             => $center->avgRating(),
            'ratings_count'          => $center->ratingsCount(),
            'license_status'         => $center->license_status,
        ];

        return view('user.dashboard', compact('stats', 'center'));
    }
}
