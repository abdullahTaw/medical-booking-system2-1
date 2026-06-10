<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\Center;
use App\Models\Country;
use App\Models\Category;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CenterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index(){
        $setting = Auth::user()->center;
        $currencies = Currency::orderBy('name','asc')->get();
        $countries = Country::orderBy('name','asc')->get();
        $cities = City::orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();

        return view('user.setting',compact('setting','currencies','countries','cities','categories'));
    }


    public function updateGeneralSetting(Request $request){

        $setting = Auth::user()->center;

        $validated = $request->validate([
            'section1_title' => 'nullable|string',
            'section1_content' => 'nullable|string',
            'section1_title_en' => 'nullable|string',
            'center_name' => 'nullable|string',
            'center_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'exists:categories,id',
            'country_id' => 'exists:countries,id',
            'city_id' => 'exists:cities,id',
            'currency_id' => 'exists:currencies,id',
            'center_address' => 'nullable|string',
            'phone' => 'nullable|string',
            'maintenance_mode' => 'nullable',
            'youtube_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'overview' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);
        $validated['center_logo']= $setting->center_logo;
        if($request->hasFile('center_logo') && $request->file('center_logo')->isValid()){
            if($setting->center_logo)
                Storage::disk('files')->delete($setting->center_logo);
            $validated['center_logo'] = $request->file('center_logo')->store('/','files');
        }

        $setting->update($validated);

        $notification = trans(' Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
