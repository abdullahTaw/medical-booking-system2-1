<?php

namespace App\Http\Controllers\Patient;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'center_id' => ['required', 'exists:centers,id'],
            'rating'    => ['required', 'integer', 'min:1', 'max:5'],
            'comment'   => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            $errorMsg = app()->getLocale() == 'ar'
                ? 'يرجى اختيار تقييم بالنجوم قبل الإرسال'
                : 'Please select a star rating before submitting';

            return redirect()->route('site.center', $request->center_id)
                ->with(['messege' => $errorMsg, 'alert-type' => 'warning']);
        }

        Rating::updateOrCreate(
            [
                'user_id'   => Auth::id(),
                'center_id' => $request->center_id,
            ],
            [
                'rating'     => $request->rating,
                'comment'    => $request->comment,
                'ip_address' => $request->ip(),
                'status'     => 'active',
            ]
        );

        $notification = [
            'messege'    => app()->getLocale() == 'ar' ? 'تم حفظ تقييمك، شكراً لك!' : 'Your rating has been saved, thank you!',
            'alert-type' => 'success',
        ];

        return redirect()->route('site.center', $request->center_id)->with($notification);
    }

    public function destroy(Request $request, $centerId)
    {
        $rating = Rating::where('user_id', Auth::id())
            ->where('center_id', $centerId)
            ->first();

        if ($rating) {
            $rating->delete();

            $notification = [
                'messege'    => app()->getLocale() == 'ar' ? 'تم حذف تقييمك بنجاح' : 'Your rating has been deleted',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'messege'    => app()->getLocale() == 'ar' ? 'لا يوجد تقييم لحذفه' : 'No rating found to delete',
                'alert-type' => 'warning',
            ];
        }

        return redirect()->route('site.center', $centerId)->with($notification);
    }
}
