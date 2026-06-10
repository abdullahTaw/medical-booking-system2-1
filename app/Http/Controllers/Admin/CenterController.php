<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\User;
use App\Models\Center;
use App\Models\Country;
use App\Models\Category;
use App\Models\Currency;
use App\Mail\LicenseApprovedMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::latest()->get();
        return view('admin.center.centers', compact('centers'));
    }

    public function show(Center $center)
    {
        return view('admin.center.show', compact('center'));
    }

    public function create()
    {
        $currencies = Currency::orderBy('name', 'asc')->get();
        $countries  = Country::orderBy('name', 'asc')->get();
        $cities     = City::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.center.create_center', compact('categories', 'cities', 'countries', 'currencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
            'center_name'      => 'nullable|string',
            'center_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'      => 'exists:categories,id',
            'country_id'       => 'exists:countries,id',
            'city_id'          => 'exists:cities,id',
            'currency_id'      => 'exists:currencies,id',
            'center_address'   => 'nullable|string',
            'phone'            => 'nullable|string',
            'maintenance_mode' => 'nullable',
            'youtube_url'      => 'nullable|string',
            'instagram_url'    => 'nullable|string',
            'facebook_url'     => 'nullable|string',
            'twitter_url'      => 'nullable|string',
            'overview'         => 'nullable|string',
            'latitude'         => 'nullable|string',
            'longitude'        => 'nullable|string',
            'license_number'   => 'required|string|unique:centers,license_number',
            'license_file'     => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        $center_logo = null;
        if ($request->hasFile('center_logo') && $request->file('center_logo')->isValid()) {
            $center_logo = $request->file('center_logo')->store('/', 'files');
        }

        $license_file = $request->file('license_file')->store('licenses', 'files');

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Center::create([
            'center_name'      => $request->center_name,
            'center_logo'      => $center_logo,
            'category_id'      => $request->category_id,
            'country_id'       => $request->country_id,
            'city_id'          => $request->city_id,
            'user_id'          => $user->id,
            'currency_id'      => $request->currency_id,
            'center_address'   => $request->center_address,
            'phone'            => $request->phone,
            'maintenance_mode' => $request->maintenance_mode ?? '0',
            'youtube_url'      => $request->youtube_url,
            'instagram_url'    => $request->instagram_url,
            'facebook_url'     => $request->facebook_url,
            'twitter_url'      => $request->twitter_url,
            'overview'         => $request->overview,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'license_number'   => $request->license_number,
            'license_file'     => $license_file,
            'license_status'   => 'approved', // الأدمن يضيف مباشرة — موافق تلقائياً
            'status'           => 'active',
        ]);

        $notification = array('messege' => trans('Created Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.center.index')->with($notification);
    }

    public function edit($id)
    {
        $currencies = Currency::orderBy('name', 'asc')->get();
        $countries  = Country::orderBy('name', 'asc')->get();
        $cities     = City::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $center     = Center::find($id);
        return view('admin.center.edit_center', compact('center', 'categories', 'cities', 'countries', 'currencies'));
    }

    public function update(Request $request, $id)
    {
        $center = Center::find($id);

        $validated = $request->validate([
            'center_name'      => 'nullable|string',
            'center_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'      => 'exists:categories,id',
            'country_id'       => 'exists:countries,id',
            'city_id'          => 'exists:cities,id',
            'currency_id'      => 'exists:currencies,id',
            'center_address'   => 'nullable|string',
            'phone'            => 'nullable|string',
            'maintenance_mode' => 'nullable',
            'youtube_url'      => 'nullable|string',
            'instagram_url'    => 'nullable|string',
            'facebook_url'     => 'nullable|string',
            'twitter_url'      => 'nullable|string',
            'overview'         => 'nullable|string',
            'latitude'         => 'nullable|string',
            'longitude'        => 'nullable|string',
            'license_number'   => 'nullable|string|unique:centers,license_number,' . $center->id,
            'license_file'     => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        $validated['center_logo'] = $center->center_logo;
        if ($request->hasFile('center_logo') && $request->file('center_logo')->isValid()) {
            if ($center->center_logo) Storage::disk('files')->delete($center->center_logo);
            $validated['center_logo'] = $request->file('center_logo')->store('/', 'files');
        }

        $validated['license_file'] = $center->license_file;
        if ($request->hasFile('license_file') && $request->file('license_file')->isValid()) {
            if ($center->license_file) Storage::disk('files')->delete($center->license_file);
            $validated['license_file'] = $request->file('license_file')->store('licenses', 'files');
        }

        $center->update($validated);

        $notification = array('messege' => trans('updated Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.center.index')->with($notification);
    }

    public function destroy($id)
    {
        $center = Center::find($id);
        if ($center->license_file) Storage::disk('files')->delete($center->license_file);
        $center->delete();
        $notification = array('messege' => trans('Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('admin.center.index')->with($notification);
    }

    public function changeStatus($id)
    {
        $center = Center::find($id);
        if ($center->status == 'active') {
            $center->status = 'inactive';
            $message = trans('Inactive Successfully');
        } else {
            $center->status = 'active';
            $message = trans('Active Successfully');
        }
        $center->save();
        return response()->json($message);
    }

    // ===== الموافقة على الترخيص — يرسل إيميل =====
    public function approveLicense($id)
    {
        $center = Center::find($id);
        $center->license_status = 'approved';
        $center->status         = 'active';
        $center->save();

        // إرسال إيميل للعيادة
        try {
            Mail::to($center->user->email)->send(new LicenseApprovedMail($center));
        } catch (\Exception $e) {
            // لا نوقف العملية إذا فشل الإيميل
        }

        return response()->json(
            app()->getLocale() == 'ar' ? 'تمت الموافقة وإرسال الإيميل ✓' : 'Approved and email sent ✓'
        );
    }

    // ===== رفض الترخيص =====
    public function rejectLicense($id)
    {
        $center = Center::find($id);
        $center->license_status = 'rejected';
        $center->status         = 'inactive';
        $center->save();

        return response()->json(
            app()->getLocale() == 'ar' ? 'تم رفض الترخيص' : 'License rejected'
        );
    }
}
