<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::latest()->get();
        return view('admin.city.cities',compact('cities'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->pluck('name', 'id')->toArray();
        $modalContent = view('admin.city.create_city',compact('countries'))->render();

        return response()->json(['modalContent' => $modalContent]);
    }


    public function store(Request $request)
    {

        // التحقق من المدخلات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
        ] );
        City::create($validated);

        $notification = trans('Created Successfully');
        return response()->json(['redirect_url' => route('admin.city.index'),
        'notification' => $notification ]
    );
    }

    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::orderBy('name')->pluck('name', 'id')->toArray();

        $modalContent = view('admin.city.edit_city',compact('city','countries'))->render();
        return response()->json(['modalContent' => $modalContent]);

    }


    public function update(Request $request,$id)
    {
        $city = City::find($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
        ] );
        $city->update($validated);

        $notification = trans('dash.Updated Successfully');
        return response()->json(['redirect_url' => route('admin.city.index'),
        'notification' => $notification ]
    );
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        $notification = trans('Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }

    public function changeStatus($id){
        $city = City::find($id);
            if($city->status=='active'){
                $city->status='inactive';
                $city->save();
                $message = trans('Inactive Successfully');
            }else{
                $city->status='active';
                $city->save();
                $message= trans('Active Successfully');
            }
            return response()->json($message);
    }

}
