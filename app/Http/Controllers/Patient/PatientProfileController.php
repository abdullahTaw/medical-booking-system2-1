<?php

namespace App\Http\Controllers\Patient;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PatientProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $orders = Order::where('email', $user->email)
            ->orWhere('phone', $user->phone)
            ->latest()
            ->get();

        return view('patient.profile', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $notification = ['messege' => app()->getLocale() == 'ar' ? 'تم تحديث الملف الشخصي' : 'Profile updated', 'alert-type' => 'success'];
        return redirect()->route('patient.profile')->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $notification = ['messege' => app()->getLocale() == 'ar' ? 'تم تغيير كلمة المرور' : 'Password changed', 'alert-type' => 'success'];
        return redirect()->route('patient.profile')->with($notification);
    }

    public function destroy(Request $request)
{
    $user = Auth::user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('site.show')->with([
        'messege'    => app()->getLocale() == 'ar' ? 'تم حذف حسابك بنجاح' : 'Your account has been deleted',
        'alert-type' => 'success',
    ]);
}
}
