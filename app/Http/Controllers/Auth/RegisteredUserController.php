<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Center;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
            'clinic_name'      => ['required', 'string', 'max:255'],
            'category_id'      => ['required', 'integer'],
            'country_id'       => ['required', 'integer'],
            'city_id'          => ['required', 'integer'],
            'address'          => ['required', 'string', 'max:255'],
            'phone'            => ['required', 'string', 'max:20'],
            // ===== الترخيص =====
            'license_number'   => ['required', 'string', 'unique:centers,license_number'],
            'license_file'     => ['required', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:5120'],
        ], [
            'license_number.required' => app()->getLocale() == 'ar' ? 'رقم الترخيص مطلوب' : 'License number is required',
            'license_number.unique'   => app()->getLocale() == 'ar' ? 'رقم الترخيص مستخدم بالفعل' : 'License number already exists',
            'license_file.required'   => app()->getLocale() == 'ar' ? 'ملف الترخيص مطلوب' : 'License file is required',
            'license_file.mimes'      => app()->getLocale() == 'ar' ? 'يجب أن يكون الملف PDF أو صورة' : 'File must be PDF or image',
            'license_file.max'        => app()->getLocale() == 'ar' ? 'حجم الملف لا يتجاوز 5MB' : 'File size must not exceed 5MB',
        ]);

        // رفع ملف الترخيص
        $license_file = $request->file('license_file')->store('licenses', 'files');

        // إنشاء المستخدم
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // إنشاء المركز مع الترخيص
        Center::create([
            'category_id'    => $request->category_id,
            'country_id'     => $request->country_id,
            'city_id'        => $request->city_id,
            'user_id'        => $user->id,
            'center_name'    => $request->clinic_name,
            'center_address' => $request->address,
            'phone'          => $request->phone,
            // ===== الترخيص =====
            'license_number' => $request->license_number,
            'license_file'   => $license_file,
            'license_status' => 'pending', // تنتظر مراجعة الأدمن
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('user.dashboard', absolute: false));
    }
}
