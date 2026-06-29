@extends('layouts.dash_master')
@section('title')
<title>{{ app()->getLocale() == 'ar' ? 'الملف الشخصي' : 'My Profile' }}</title>
@endsection

@if(Auth::user()->role === 'admin')
    @include('layouts.admin_sidebar')
@else
    @include('layouts.user_sidebar')
@endif

@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ app()->getLocale() == 'ar' ? 'الملف الشخصي' : 'My Profile' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}">
                        {{ __('admin.Dashboard') }}
                    </a>
                </div>
                <div class="breadcrumb-item">{{ app()->getLocale() == 'ar' ? 'الملف الشخصي' : 'Profile' }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-4">

                {{-- بطاقة المستخدم --}}
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body" style="text-align:center; padding:30px;">
                            <div style="width:90px; height:90px; border-radius:50%; background:#6777ef; color:#fff;
                                display:flex; align-items:center; justify-content:center; font-size:36px; font-weight:700;
                                margin:0 auto 16px;">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>
                            <h4 style="margin-bottom:4px;">{{ $user->name }}</h4>
                            <p style="color:#999; font-size:13px; margin-bottom:4px;">{{ $user->email }}</p>
                            <span class="badge badge-primary">
    @if($user->role === 'admin')
        {{ app()->getLocale() == 'ar' ? 'مدير النظام' : 'Admin' }}
    @elseif($user->role === 'user')
        {{ app()->getLocale() == 'ar' ? 'عيادة' : 'Clinic' }}
    @else
        {{ $user->role }}
    @endif
</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">

                    {{-- تعديل البيانات --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ app()->getLocale() == 'ar' ? 'تعديل البيانات الشخصية' : 'Edit Profile Information' }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.profile.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'الاسم الكامل' : 'Full Name' }}</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    @error('name')<span class="text-danger" style="font-size:12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    @error('email')<span class="text-danger" style="font-size:12px;">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ app()->getLocale() == 'ar' ? 'حفظ التعديلات' : 'Save Changes' }}
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- تغيير كلمة المرور --}}
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>{{ app()->getLocale() == 'ar' ? 'تغيير كلمة المرور' : 'Change Password' }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.profile.password') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'كلمة المرور الحالية' : 'Current Password' }}</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                    @error('current_password')<span class="text-danger" style="font-size:12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'كلمة المرور الجديدة' : 'New Password' }}</label>
                                    <input type="password" id="new_password" name="password" class="form-control" required>
                                    @include('components.password-strength', ['inputId' => 'new_password'])
                                    @error('password')<span class="text-danger" style="font-size:12px;">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ app()->getLocale() == 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ app()->getLocale() == 'ar' ? 'تغيير كلمة المرور' : 'Change Password' }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($user->role !== 'admin')
<div class="card mt-4" style="border:1px solid #f8d7da;">
    <div class="card-header">
        <h4 style="color:#e74c3c;">{{ app()->getLocale() == 'ar' ? 'حذف الحساب' : 'Delete Account' }}</h4>
    </div>
    <div class="card-body">
        <p style="color:#999; font-size:13px; margin-bottom:14px;">
            {{ app()->getLocale() == 'ar'
                ? 'سيتم حذف حسابك وجميع بياناتك بشكل نهائي. لا يمكن التراجع عن هذا الإجراء.'
                : 'Your account and all your data will be permanently deleted. This action cannot be undone.' }}
        </p>
        <form method="POST" action="{{ route('dashboard.profile.destroy') }}"
            onsubmit="return confirm('{{ app()->getLocale() == "ar" ? "هل أنت متأكد من حذف حسابك؟" : "Are you sure you want to delete your account?" }}')">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
                {{ app()->getLocale() == 'ar' ? 'حذف حسابي' : 'Delete My Account' }}
            </button>
        </form>
    </div>
</div>
@endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
