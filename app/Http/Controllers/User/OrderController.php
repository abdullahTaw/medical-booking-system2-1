<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // FIX: كان المتغير اسمه $site لكنه يحمل Center — صححنا الاسم إلى $center
        $center = Auth::user()->center ?? null;

        if ($center) {
            $orders = $center->orders()->latest()->get();
        } else {
            $orders = collect();
        }
        return view('user.orders.orders', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::find($id);

        // FIX: كان يدخل بالـ if فقط إذا كان center_id مساوياً ولا يرجع شيئاً عند الرفض
        // صححنا إلى تحقق معكوس مع return 403
        if (!$order || $order->center_id != Auth::user()->center->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $services = Auth::user()->center->services()->pluck('name', 'id')->toArray() ?? collect();
        $modalContent = view('user.orders.edit_order', compact('order', 'services'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        // FIX: كان return; فارغاً — صححنا إلى return 403
        if (!$order || $order->center_id != Auth::user()->center->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $messages = [
            'name.required'        => 'اسم المريض مطلوب.',
            'email.email'          => 'يرجى إدخال بريد إلكتروني صالح.',
            'gender.in'            => 'الجنس يجب أن يكون ذكر أو أنثى فقط.',
            'appointment_date.date'=> 'تاريخ الموعد يجب أن يكون بتنسيق صحيح.',
        ];

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'nullable|email',
            'phone'            => 'required|string',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
            'notes'            => 'nullable|string',
            'service_id'       => 'nullable',
            'gender'           => 'nullable|in:male,female',
            'status'           => 'nullable|string',
        ], $messages);

        $order->update($validated);

        $notification = trans('تم التعديل بنجاح');
        return response()->json(['redirect_url' => route('user.order.index'), 'notification' => $notification]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order || $order->center_id != Auth::user()->center->id) {
            $notification = array('messege' => trans('you dont have permission to access this resource'), 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        $order->delete();

        $notification = array('messege' => trans('Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('user.order.index')->with($notification);
    }
}
