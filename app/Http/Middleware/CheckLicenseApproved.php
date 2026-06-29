<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLicenseApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $next($request);
        }

        if ($user->center) {
            $status = $user->center->license_status;

            if ($status === 'pending' || $status === 'rejected') {
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => $status === 'pending'
                            ? 'عيادتك قيد المراجعة'
                            : 'تم رفض طلب عيادتك'
                    ], 403);
                }

                return redirect()->route('user.pending');
            }
        }

        return $next($request);
    }
}
