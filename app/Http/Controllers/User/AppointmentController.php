<?php

namespace App\Http\Controllers\User;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $center = Auth::user()->center;

        if ($center) {
            $appointments = $center->appointments()->latest()->get();
        } else {
            $appointments = collect();
        }
        return view('user.appointment.appointments', compact('appointments'));
    }

    public function create()
    {
        $services = Auth::user()->center->services()->pluck('name', 'id')->toArray() ?? collect();
        $patients = Auth::user()->center->patients()->pluck('name', 'id')->toArray() ?? collect();
        $modalContent = view('user.appointment.create_appointment', compact('patients', 'services'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function store(Request $request)
    {
        $messages = [
            'patient_id.required'          => 'يجب اختيار مريض.',
            'patient_id.exists'            => 'المريض المحدد غير موجود.',
            'service_id.required'          => 'يجب اختيار خدمة.',
            'service_id.exists'            => 'الخدمة المحددة غير موجودة.',
            'appointment_date.required'    => 'يجب تحديد تاريخ الموعد.',
            'appointment_date.date'        => 'يجب أن يكون تاريخ الموعد بتنسيق صحيح.',
            'appointment_date.after_or_equal' => 'تاريخ الموعد يجب أن يكون اليوم أو بعده.',
            'appointment_time.required'    => 'يجب تحديد وقت الموعد.',
            'appointment_time.date_format' => 'وقت الموعد يجب أن يكون بتنسيق ساعة ودقيقة (HH:mm).',
            'notes.string'                 => 'الملاحظات يجب أن تكون نصاً.',
            'notes.max'                    => 'الملاحظات لا يمكن أن تتجاوز 1000 حرف.',
        ];

        $validated = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'service_id'       => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes'            => 'nullable|string|max:1000',
        ], $messages);

        $validated['center_id'] = Auth::user()->center->id;

        Appointment::create($validated);

        $notification = trans('تم التعديل بنجاح');
        return response()->json(['redirect_url' => route('user.appointment.index'), 'notification' => $notification]);
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);

        // FIX: كان يدخل بالـ if فقط إذا كان center_id مساوياً ولا يرجع شيئاً عند الرفض
        // صححنا إلى تحقق معكوس مع return 403
        if (!$appointment || $appointment->center_id != Auth::user()->center->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $services = Auth::user()->center->services()->pluck('name', 'id')->toArray() ?? collect();
        $patients = Auth::user()->center->patients()->pluck('name', 'id')->toArray() ?? collect();
        $modalContent = view('user.appointment.edit_appointment', compact('appointment', 'services', 'patients'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        // FIX: كان return; فارغاً — صححنا إلى return 403
        if (!$appointment || $appointment->center_id != Auth::user()->center->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $messages = [
            'patient_id.required'          => 'يجب اختيار مريض.',
            'patient_id.exists'            => 'المريض المحدد غير موجود.',
            'service_id.required'          => 'يجب اختيار خدمة.',
            'service_id.exists'            => 'الخدمة المحددة غير موجودة.',
            'appointment_date.required'    => 'يجب تحديد تاريخ الموعد.',
            'appointment_date.date'        => 'يجب أن يكون تاريخ الموعد بتنسيق صحيح.',
            'appointment_date.after_or_equal' => 'تاريخ الموعد يجب أن يكون اليوم أو بعده.',
            'appointment_time.required'    => 'يجب تحديد وقت الموعد.',
            'appointment_time.date_format' => 'وقت الموعد يجب أن يكون بتنسيق ساعة ودقيقة (HH:mm).',
            'status.required'              => 'يجب تحديد حالة الموعد.',
            'status.in'                    => 'الحالة يجب أن تكون scheduled أو completed أو cancelled.',
            'notes.string'                 => 'الملاحظات يجب أن تكون نصاً.',
            'notes.max'                    => 'الملاحظات لا يمكن أن تتجاوز 1000 حرف.',
        ];

        $validated = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'service_id'       => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status'           => 'required|string|in:scheduled,completed,cancelled',
            'notes'            => 'nullable|string|max:1000',
        ], $messages);

        $appointment->update($validated);

        $notification = trans('تم التعديل بنجاح');
        return response()->json(['redirect_url' => route('user.appointment.index'), 'notification' => $notification]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment || $appointment->center_id != Auth::user()->center->id) {
            $notification = array('messege' => trans('dash.you dont have permission to access this resource'), 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        $appointment->delete();

        $notification = array('messege' => trans('dash.Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('user.appointment.index')->with($notification);
    }

    public function changeStatus($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment || $appointment->center_id != Auth::user()->center->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        // FIX: كان يعدل is_active وهو غير موجود في DB — صححنا إلى حقل status الحقيقي
        if ($appointment->status == 'scheduled') {
            $appointment->status = 'cancelled';
            $message = trans('dash.Inactive Successfully');
        } else {
            $appointment->status = 'scheduled';
            $message = trans('dash.Active Successfully');
        }

        $appointment->save();
        return response()->json($message);
    }

    public function calendar()
    {
        // placeholder
    }

    public function calendar_appointments()
    {
        $center = Auth::user()->center;

        if ($center) {
            $appointments = $center->appointments()->with('service', 'patient')->latest()->get();
            return view('user.appointment.calendar_appointments', compact('appointments'));
        }
    }
}
