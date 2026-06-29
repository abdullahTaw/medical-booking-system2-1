@extends('layouts.dash_master')
@section('title')
<title>{{ app()->getLocale() == 'ar' ? 'قيد المراجعة' : 'Under Review' }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" style="max-width:600px; margin:0 auto; border-radius:16px; overflow:hidden;">

                        <div style="background:#3498db; padding:30px; text-align:center;">
                            <div style="font-size:56px; margin-bottom:10px;">⏳</div>
                            <h2 style="color:#fff; margin:0; font-size:22px;">
                                {{ app()->getLocale() == 'ar' ? 'عيادتك قيد المراجعة' : 'Your Clinic is Under Review' }}
                            </h2>
                        </div>

                        <div class="card-body" style="padding:30px; text-align:center;">

                            @if(Auth::user()->center->license_status === 'rejected')
                                {{-- مرفوضة --}}
                                <div style="background:#fff0f0; border:1px solid #e74c3c; border-radius:10px; padding:20px; margin-bottom:24px;">
                                    <p style="color:#e74c3c; font-size:16px; font-weight:600; margin-bottom:8px;">
                                        🚫 {{ app()->getLocale() == 'ar' ? 'تم رفض طلبك' : 'Your application was rejected' }}
                                    </p>
                                    <p style="color:#666; font-size:14px; margin:0;">
                                        {{ app()->getLocale() == 'ar'
                                            ? 'للأسف تم رفض ترخيص عيادتك. يرجى التواصل مع الإدارة لمعرفة السبب وإمكانية إعادة التقديم.'
                                            : 'Unfortunately, your clinic license was rejected. Please contact support to learn why and how to reapply.' }}
                                    </p>
                                </div>
                            @else
                                {{-- قيد المراجعة --}}
                                <div style="background:#fff8e1; border:1px solid #ffc107; border-radius:10px; padding:20px; margin-bottom:24px;">
                                    <p style="color:#856404; font-size:15px; margin:0; line-height:1.7;">
                                        {{ app()->getLocale() == 'ar'
                                            ? 'تم استلام طلبك بنجاح. فريقنا يراجع ملف الترخيص وسيتم تفعيل حسابك فور الموافقة.'
                                            : 'Your application has been received. Our team is reviewing your license file and your account will be activated upon approval.' }}
                                    </p>
                                </div>

                                {{-- خطوات --}}
                                <div style="text-align:{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}; background:#f8f9fa; border-radius:10px; padding:20px; margin-bottom:24px;">
                                    <p style="font-size:13px; color:#555; margin-bottom:10px; font-weight:600;">
                                        {{ app()->getLocale() == 'ar' ? 'حالة طلبك:' : 'Your application status:' }}
                                    </p>
                                    <p style="font-size:13px; color:#27ae60; margin-bottom:8px;">✓ {{ app()->getLocale() == 'ar' ? 'تم استلام الطلب' : 'Application received' }}</p>
                                    <p style="font-size:13px; color:#f39c12; margin-bottom:0;">⏳ {{ app()->getLocale() == 'ar' ? 'مراجعة الترخيص (جارٍ...)' : 'License review (in progress...)' }}</p>
                                </div>
                            @endif

                            <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                                    {{ app()->getLocale() == 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                                </a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="btn btn-outline-danger btn-sm">
                                    {{ app()->getLocale() == 'ar' ? 'تسجيل الخروج' : 'Logout' }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
