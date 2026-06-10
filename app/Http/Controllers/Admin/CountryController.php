<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->get();
        return view('admin.country.countries',compact('countries'));
    }

    public function create()
    {
        $modalContent = view('admin.country.create_country')->render();

        return response()->json(['modalContent' => $modalContent]);
    }


    public function store(Request $request)
    {

        // التحقق من المدخلات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ] );
        Country::create($validated);

        $notification = trans('Created Successfully');
        return response()->json(['redirect_url' => route('admin.country.index'),
        'notification' => $notification ]
    );
    }

    public function edit($id)
    {
        $country = Country::find($id);
        $modalContent = view('admin.country.edit_country',compact('country'))->render();
        return response()->json(['modalContent' => $modalContent]);

    }


    public function update(Request $request,$id)
    {
        $country = Country::find($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ] );
        $country->update($validated);

        $notification = trans('dash.Updated Successfully');
        return response()->json(['redirect_url' => route('admin.country.index'),
        'notification' => $notification ]
    );
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        $notification = trans('Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.country.index')->with($notification);
    }

    public function changeStatus($id){
        $country = Country::find($id);
            if($country->status=='active'){
                $country->status='inactive';
                $country->save();
                $message = trans('Inactive Successfully');
            }else{
                $country->status='active';
                $country->save();
                $message= trans('Active Successfully');
            }
            return response()->json($message);
    }

}
