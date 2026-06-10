<?php

namespace App\Http\Controllers\User;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        $site = Auth::user()->center->site;
        return view('user.site-setting', compact('site'));
    }

    public function updateSiteSetting(Request $request)
    {
        $site = Auth::user()->center->site;

        $validated = $request->validate([
            'name'        => 'nullable|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:sites,slug,' . $site->id,
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email',
            'address'     => 'nullable|string',
            'title1'      => 'nullable|string',
            'title2'      => 'nullable|string',
            'title3'      => 'nullable|string',
            'text1'       => 'nullable|string',
            'text2'       => 'nullable|string',
            'text21'      => 'nullable|string',
            'text3'       => 'nullable|string',
            'num1'        => 'nullable|integer',
            'num2'        => 'nullable|integer',
            'whatsapp'    => 'nullable|string|max:20',
            'facebook'    => 'nullable|string|max:255',
            'instagram'   => 'nullable|string|max:255',
            'site_logo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // site_logo
        if ($request->hasFile('site_logo') && $request->file('site_logo')->isValid()) {
            if ($site->site_logo) Storage::disk('files')->delete($site->site_logo);
            $validated['site_logo'] = $request->file('site_logo')->store('/', 'files');
        }

        // footer_logo
        if ($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()) {
            if ($site->footer_logo) Storage::disk('files')->delete($site->footer_logo);
            $validated['footer_logo'] = $request->file('footer_logo')->store('/', 'files');
        }

        // favicon
        if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {
            if ($site->favicon) Storage::disk('files')->delete($site->favicon);
            $validated['favicon'] = $request->file('favicon')->store('/', 'files');
        }

        // image (hero/section image)
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($site->image) Storage::disk('files')->delete($site->image);
            $validated['image'] = $request->file('image')->store('/', 'files');
        }

        $site->update($validated);

        $notification = array('messege' => trans('dash.Update Successfully'), 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
