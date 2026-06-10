<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCitiesByCountry(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        return response()->json($cities);
    }
}
