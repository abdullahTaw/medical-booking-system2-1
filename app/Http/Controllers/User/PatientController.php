<?php

namespace App\Http\Controllers\User;

use App\Models\Country;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function index()
    {
        $center = Auth::user()->center;

        if ($center) {
            $patients = $center->patients()->latest()->get();
        } else {
            $patients = collect();
        }
        return view('user.patient.patients', compact('patients'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->pluck('name', 'id')->toArray();
        $modalContent = view('user.patient.create_patient', compact('countries'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required'  => 'اسم المريض مطلوب.',
            'email.email'    => 'يرجى إدخال بريد إلكتروني صالح.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique'   => 'رقم الهاتف مستخدم بالفعل.',
            'gender.in'      => 'الجنس يجب أن يكون ذكر أو أنثى فقط.',
            'date_of_birth.date' => 'تاريخ الميلاد يجب أن يكون بتنسيق صحيح.',
        ];

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'nullable|email|unique:patients,email',
            'phone'          => 'required|string|unique:patients,phone',
            'gender'         => 'nullable|in:male,female',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string',
            'city'           => 'nullable|string',
            'state'          => 'nullable|string',
            'country'        => 'nullable|string',
            'medical_history'=> 'nullable|string',
            'blood_type'     => 'nullable|string|max:3',
            'allergies'      => 'nullable|string',
        ], $messages);

        $validated['center_id'] = Auth::user()->center->id;

        Patient::create($validated);

        $notification = trans('Successfully');
        return response()->json(['redirect_url' => route('user.patient.index'), 'notification' => $notification]);
    }

    public function edit($id)
    {
        $patient = Patient::find($id);

        if (!$patient || $patient->center->user_id != Auth::user()->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $countries = Country::orderBy('name')->pluck('name', 'id')->toArray();
        $modalContent = view('user.patient.edit_patient', compact('patient', 'countries'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient || $patient->center->user_id != Auth::user()->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $messages = [
            'name.required'  => 'اسم المريض مطلوب.',
            'email.email'    => 'يرجى إدخال بريد إلكتروني صالح.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique'   => 'رقم الهاتف مستخدم بالفعل.',
            'gender.in'      => 'الجنس يجب أن يكون ذكر أو أنثى فقط.',
            'date_of_birth.date' => 'تاريخ الميلاد يجب أن يكون بتنسيق صحيح.',
        ];

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'nullable|email|unique:patients,email,' . $patient->id,
            'phone'          => 'required|string|unique:patients,phone,' . $patient->id,
            'gender'         => 'nullable|in:male,female',
            'date_of_birth'  => 'nullable|date',
            'address'        => 'nullable|string',
            'city'           => 'nullable|string',
            'state'          => 'nullable|string',
            'country'        => 'nullable|string',
            'medical_history'=> 'nullable|string',
            'blood_type'     => 'nullable|string|max:3',
            'allergies'      => 'nullable|string',
        ], $messages);

        $patient->update($validated);

        $notification = trans('Successfully');
        return response()->json(['redirect_url' => route('user.patient.index'), 'notification' => $notification]);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        // FIX: كان $patient->user_id — لا يوجد user_id في patients، صححنا إلى center_id
        if (!$patient || $patient->center_id != Auth::user()->center->id) {
            $notification = array('messege' => trans('dash.you dont have permission to access this resource'), 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        // FIX: حذفنا سطر $patient->icon لأن هذا الحقل غير موجود في جدول patients

        $patient->delete();

        $notification = array('messege' => trans('dash.Delete Successfully'), 'alert-type' => 'success');
        return redirect()->route('user.patient.index')->with($notification);
    }

    public function changeStatus($id)
    {
        $patient = Patient::find($id);

        // FIX: كان $patient->user_id — صححنا إلى center_id
        if (!$patient || $patient->center_id != Auth::user()->center->id) {
            $notification = array('messege' => trans('dash.you dont have permission to access this resource'), 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        if ($patient->status == 1) {
            $patient->status = 0;
            $message = trans('dash.Inactive Successfully');
        } else {
            $patient->status = 1;
            $message = trans('dash.Active Successfully');
        }

        $patient->save();
        return response()->json($message);
    }
}
