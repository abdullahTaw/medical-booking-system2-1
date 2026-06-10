<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        // الأدمن — يدخل مباشرة
        if ($user->role === 'admin') {
            return redirect()->intended('admin/dashboard');
        }

        // صاحب عيادة — تحقق من حالة الترخيص
        if ($user->center) {
            $status = $user->center->license_status;

            // قيد المراجعة
            if ($status === 'pending') {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('license_error',
                    app()->getLocale() == 'ar'
                        ? 'عيادتك لا تزال قيد المراجعة. سيصلك إيميل عند الموافقة.'
                        : 'Your clinic is still under review. You will receive an email upon approval.'
                );
            }

            // مرفوضة
            if ($status === 'rejected') {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('license_error',
                    app()->getLocale() == 'ar'
                        ? 'تم رفض طلب عيادتك. يرجى التواصل مع الإدارة.'
                        : 'Your clinic application was rejected. Please contact support.'
                );
            }
        }

        // عيادة موافق عليها
        return redirect()->intended('dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
