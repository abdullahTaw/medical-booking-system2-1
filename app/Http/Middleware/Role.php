<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        if ($user->role == $role) {
            return $next($request);
        }

        if ($user->role === 'patient') {
            return redirect()->route('site.show');
        }

        $notification = trans('dash.you dont have permission to access this resource');
        $notification = ['messege' => $notification, 'alert-type' => 'warning'];
        return redirect()->back()->with($notification);
    }
}
