<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CenterRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مخولًا بتقديم هذا الطلب.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // السماح للجميع باستخدام هذا الطلب
    }

    /**
     * قواعد التحقق من البيانات.
     *
     * @return array
     */
    public function rules()
    {
        $id = Auth::user()->center->id ?? null;

        return [
            'currency_id' => 'nullable|exists:currencies,id',  // يجب أن يكون موجودًا في جدول العملات
            'center_name' => 'nullable|string|max:255',
            'center_name_en' => 'required|string|max:255|unique:centers,center_name_en,' . $id, // فريد
            'center_email' => 'nullable|email|max:255',
            'center_phone' => 'nullable|string|max:15',
            'currency_short' => 'nullable|string|max:10',
            'center_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',  // صورة اختيارية
            'footer_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',  // صورة اختيارية
            'center_address' => 'nullable|string|max:500',
            'maintenance_mode' => 'nullable|boolean',  // يجب أن تكون 0 أو 1
            'timezone' => 'nullable|string|max:255',  // التحقق من صحة المنطقة الزمنية
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ];
    }

    /**
     * رسائل الخطأ المخصصة.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'currency_id.exists' => 'العملة المحددة غير موجودة.',
            'center_name_en.unique' => 'اسم المتجر باللغة الإنجليزية مستخدم مسبقًا.',
            'center_email.email' => 'يجب أن يكون البريد الإلكتروني بصيغة صحيحة.',
            'center_phone.max' => 'رقم الهاتف يجب ألا يتجاوز 15 حرفًا.',
            'center_logo.image' => 'يجب أن يكون الشعار صورة.',
            'center_logo.mimes' => 'يجب أن تكون الصورة بإحدى الصيغ التالية: jpg, jpeg, png, gif, svg.',
            'footer_logo.image' => 'يجب أن يكون شعار التذييل صورة.',
            'footer_logo.mimes' => 'يجب أن تكون صورة التذييل بإحدى الصيغ التالية: jpg, jpeg, png, gif, svg.',
            'maintenance_mode.boolean' => 'يجب أن تكون حالة وضع الصيانة إما 0 أو 1.',
            'facebook_url.url' => 'رابط Facebook يجب أن يكون بتنسيق URL صحيح.',
            'twitter_url.url' => 'رابط Twitter يجب أن يكون بتنسيق URL صحيح.',
            'instagram_url.url' => 'رابط Instagram يجب أن يكون بتنسيق URL صحيح.',
            'linkedin_url.url' => 'رابط LinkedIn يجب أن يكون بتنسيق URL صحيح.',
            'youtube_url.url' => 'رابط YouTube يجب أن يكون بتنسيق URL صحيح.',
        ];
    }
}
