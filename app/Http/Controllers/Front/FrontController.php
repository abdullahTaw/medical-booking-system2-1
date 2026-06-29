<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Site;
use App\Models\Order;
use App\Models\Center;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function home(){
    $categories = Category::active()->get();
    $centers    = Center::active()->get();
    $centersCount = Center::active()->count();
    $usersCount   = \App\Models\User::count();
    return view('site.site', compact('categories', 'centers', 'centersCount', 'usersCount'));
}

    public function centers(Request $request)
    {
        $search      = $request->search      ?? '';
        $city_id     = $request->city_id     ?? '';
        $category_id = $request->category_id ?? '';

        $centers    = Center::active()->filter($search, $city_id, $category_id)->get();
        $categories = Category::active()->get();
        $cities     = City::active()->get();

        return view('site.centers', compact('categories', 'centers', 'cities'));
    }

    public function storem(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Message::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'subject'     => $request->subject,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent!');
    }

    public function center($id)
    {
        $center = Center::find($id);
        return view('site.center', compact('center'));
    }

    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return response()->json(['cities' => $cities]);
    }


public function order(Request $request)
{
    if (!auth()->check()) {
        session(['url.intended' => url()->previous()]);
        return redirect()->route('patient.register')
            ->with('error', app()->getLocale() == 'ar'
                ? 'يجب إنشاء حساب مريض أولاً'
                : 'Please create a patient account first');
    }

    $validated = $request->validate([
        'name'             => 'required|string|max:255',
        'email'            => 'nullable|email',
        'phone'            => 'required|string',
        'appointment_date' => 'nullable|date',
        'notes'            => 'nullable|string',
        'service_id'       => 'nullable',
        'gender'           => 'nullable|in:male,female',
        'center_id'        => 'required',
    ]);

    $email = Center::find($request->center_id)->user->email;
    $url   = route('user.order.index');

    Mail::raw("طلب حجز جديد! راجع الطلبات على لوحة التحكم: {$url}", function ($message) use ($email) {
        $message->to($email)->subject('طلب حجز جديد');
    });

    Order::create($validated);

    return redirect()->back()->with('success', 'Your order has been sent!');
}

public function about()
{
    return view('site.about');
}
}
