<?php

namespace App\Http\Controllers\User;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function create()
    {
        $modalContent = view('user.sliders.create_slider')->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slider_image' => 'nullable|image|mimes:jpg,png,jpeg',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
        ]);

        $data['site_id'] = Auth::user()->center->site->id;

        if ($request->hasFile('slider_image') && $request->file('slider_image')->isValid()) {
            $data['slider_image'] = $request->file('slider_image')->store('/', 'files');
        }

        Slider::create($data);

        $notification = trans('dash.Created Successfully');
        return response()->json(['message' => $notification]);
    }

    public function edit($id)
    {
        $slider = Slider::find($id);

        // FIX: أضفنا return 403 بدل عدم الرجوع بأي شيء
        if (!$slider || $slider->site_id != Auth::user()->center->site->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $modalContent = view('user.sliders.edit_slider', compact('slider'))->render();
        return response()->json(['modalContent' => $modalContent]);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);

        // FIX: أضفنا return 403 بدل return فارغ
        if (!$slider || $slider->site_id != Auth::user()->center->site->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        $data = $request->validate([
            'slider_image' => 'nullable|image|mimes:jpg,png,jpeg',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('slider_image') && $request->file('slider_image')->isValid()) {
            if ($slider->slider_image) {
                Storage::disk('files')->delete($slider->slider_image);
            }
            $data['slider_image'] = $request->file('slider_image')->store('/', 'files');
        }

        $slider->update($data);

        $notification = trans('dash.Update Successfully');
        return response()->json(['message' => $notification]);
    }

    public function destroy($id)
    {
        // FIX: كان Service::find() — صححنا إلى Slider::find()
        $slider = Slider::find($id);

        // FIX: كان يتحقق من center_id — Slider لا يملك center_id بل site_id
        if (!$slider || $slider->site_id != Auth::user()->center->site->id) {
            $notification = array('messege' => trans('dash.you dont have permission to access this resource'), 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }

        // FIX: كان يحذف $service->icon — Slider يملك slider_image
        if ($slider->slider_image) {
            Storage::disk('files')->delete($slider->slider_image);
        }

        $slider->delete();

        $notification = array('messege' => trans('dash.Delete Successfully'), 'alert-type' => 'success');
        // FIX: كان يعيد redirect إلى user.service.index — صححنا إلى user.slider.index
        return redirect()->route('user.slider.index')->with($notification);
    }

    public function changeStatus($id)
    {
        // FIX: كان service::find() بحرف صغير ونوع خاطئ — صححنا إلى Slider::find()
        $slider = Slider::find($id);

        // FIX: كان يتحقق من center_id — صححنا إلى site_id
        if (!$slider || $slider->site_id != Auth::user()->center->site->id) {
            return response()->json(['error' => trans('dash.you dont have permission to access this resource')], 403);
        }

        if ($slider->status == 1) {
            $slider->status = 0;
            $message = trans('dash.Inactive Successfully');
        } else {
            $slider->status = 1;
            $message = trans('dash.Active Successfully');
        }

        $slider->save();
        return response()->json($message);
    }
}
