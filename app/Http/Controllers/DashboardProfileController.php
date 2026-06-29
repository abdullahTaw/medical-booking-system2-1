<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DashboardProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $notification = [
            'messege'    => app()->getLocale() == 'ar' ? 'تم تحديث الملف الشخصي بنجاح' : 'Profile updated successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('dashboard.profile')->with($notification);
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $notification = [
            'messege'    => app()->getLocale() == 'ar' ? 'تم تغيير كلمة المرور بنجاح' : 'Password changed successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('dashboard.profile')->with($notification);
    }
    public function destroy(Request $request)
{
    $user = Auth::user();


    if ($user->role === 'admin') {
        return redirect()->route('dashboard.profile')->with([
            'messege'    => app()->getLocale() == 'ar' ? 'لا يمكن للمدير حذف حسابه من هنا' : 'Admin account cannot be deleted from here',
            'alert-type' => 'warning',
        ]);
    }

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
