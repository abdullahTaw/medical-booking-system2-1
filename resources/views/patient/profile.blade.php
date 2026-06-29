<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.css') }}" />
    <script src="{{ asset('assets/js/preloader.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <title>{{ app()->getLocale() == 'ar' ? 'ملفي الشخصي' : 'My Profile' }}</title>
    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif
    <style>
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }

        .profile-card { background:#fff; border-radius:14px; box-shadow:0 2px 16px rgba(0,0,0,0.06); padding:30px; margin-bottom:24px; }
        .profile-card h3 { font-size:18px; font-weight:700; margin-bottom:18px; color:#2c3e50; }
        .profile-card label { font-size:13px; color:#555; font-weight:600; margin-bottom:6px; display:block; }
        .profile-card input { width:100%; padding:10px 14px; border:1px solid #e0e0e0; border-radius:8px; margin-bottom:14px; }
        .profile-card .btn-save { background:#3498db; color:#fff; border:none; padding:10px 28px; border-radius:8px; font-weight:600; cursor:pointer; }
        .profile-card .btn-save:hover { background:#2980b9; }
        .avatar-circle { width:80px; height:80px; border-radius:50%; background:#3498db; color:#fff; display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:700; margin:0 auto 12px; }
        .orders-table { width:100%; border-collapse:collapse; font-size:13px; }
        .orders-table th, .orders-table td { padding:10px; border-bottom:1px solid #eee; text-align:{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}; }
        .orders-table th { color:#888; font-weight:600; }
        .status-badge { padding:3px 10px; border-radius:12px; font-size:11px; font-weight:600; }
        .status-pending { background:#fff3cd; color:#856404; }
        .status-approved, .status-confirmed { background:#d4edda; color:#155724; }
        .status-rejected, .status-cancelled { background:#f8d7da; color:#721c24; }
        .alert-success { background:#d4edda; color:#155724; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13px; }

        /* ===== Navbar (نفس تصميم باقي الصفحات) ===== */
        .patient-dropdown-menu { display:none; position:absolute; left:0; top:100%; background:#fff; border-radius:8px; box-shadow:0 4px 16px rgba(0,0,0,0.12); min-width:160px; z-index:9999; overflow:hidden; }
        .patient-dropdown-menu.show { display:block; }
        .patient-dropdown-menu a { display:block; padding:10px 16px; color:#333; font-size:13px; text-decoration:none; }
        .patient-dropdown-menu a:hover { background:#f5f5f5; }
        .patient-dropdown-menu a.logout { color:#e74c3c; border-top:1px solid #f0f0f0; }

        .m-nav-auth { display:flex; flex-direction:column; gap:10px; margin-top:20px; padding:16px 15px 20px; border-top:1px solid #eee; }
        .m-nav-auth a { display:block; padding:9px 14px; border-radius:6px; font-size:13px; font-weight:600; text-align:center; text-decoration:none; }
        .m-nav-auth .btn-login { border:1px solid #ddd; color:#333; }

        @media (max-width: 991px) {
            .profile-card { padding:20px; }
        }
    </style>
</head>
<body id="home2">
    <div id="preloader">
        <div class="preloader-container">
            <div class="item item-1"></div><div class="item item-2"></div>
            <div class="item item-3"></div><div class="item item-4"></div>
        </div>
    </div>

    <header class="header accent-lightBlue">
        <div class="h-bottom-container">
            <div class="container-stretch">
                <div class="h-bottom-inner">
                    <div class="p-left">
                        <div class="logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a></div>
                        <div class="m-logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a></div>
                    </div>
                    <div class="p-center">
                        <nav>
                            <ul class="main-nav">
                                <li><a href="/">{{ __('site.home') }}</a></li>
<li><a href="{{ route('site.centers') }}">{{ __('site.clinics') }}</a></li>
<li><a href="{{ route('site.show') }}#Contact">{{ __('site.contact') }}</a></li>
<li><a href="{{ route('site.about') }}">{{ __('about_us') }}</a></li>
                            </ul>
                        </nav>
                    </div>

                    {{-- ✅ نفس تصميم p-right في باقي الصفحات --}}
                    <div class="p-right" style="display:flex; align-items:center; gap:8px;">
                        <div style="position:relative;" class="patient-dropdown">
                            <button type="button" onclick="document.getElementById('patientMenu').classList.toggle('show')"
                                style="background:transparent; border:1px solid #ddd; border-radius:6px; color:#333; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; padding:6px 12px; font-size:13px;">
                                <i class="fa-solid fa-user-circle"></i>
                                {{ Auth::user()->name }}
                                <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
                            </button>
                            <div id="patientMenu" class="patient-dropdown-menu">
                                <a href="{{ route('patient.profile') }}">
                                    <i class="fa-solid fa-id-card"></i>
                                    {{ app()->getLocale() == 'ar' ? 'ملفي الشخصي' : 'My Profile' }}
                                </a>
                                <a href="javascript:;" onclick="document.getElementById('patient-logout-form').submit();" class="logout">
                                    <i class="fa-solid fa-sign-out-alt"></i>
                                    {{ app()->getLocale() == 'ar' ? 'تسجيل خروج' : 'Logout' }}
                                </a>
                                <form id="patient-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                            </div>
                        </div>

                        <form action="{{ route('locale.switch') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="locale" value="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">
                            <button type="submit" class="lang-btn">{{ __('site.language') }}</button>
                        </form>

                        <button id="m-nav-open"><i class="fa-solid fa-bars"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <aside id="m-nav-container">
        <div class="m-nav-inner">
            <button id="m-nav-close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></div>
            <ul class="main-nav">
                <li><a href="/">{{ __('site.home') }}</a></li>
                <li><a href="{{ route('site.centers') }}">{{ __('site.clinics') }}</a></li>
                <li><a href="/">{{ __('site.blog') }}</a></li>
                <li><a href="#Contact">{{ __('site.contact') }}</a></li>
            </ul>

            {{-- ✅ نفس تصميم m-nav-auth في باقي الصفحات --}}
            <div class="m-nav-auth">
                <a href="{{ route('patient.profile') }}" class="btn-login">
                    <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name }}
                </a>
                <a href="javascript:;" onclick="document.getElementById('m-logout-form').submit();" class="btn-login" style="color:#e74c3c;">
                    {{ app()->getLocale() == 'ar' ? 'تسجيل خروج' : 'Logout' }}
                </a>
                <form id="m-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

                <form action="{{ route('locale.switch') }}" method="POST">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">
                    <button type="submit" class="lang-btn" style="width:100%;">{{ __('site.language') }}</button>
                </form>
            </div>
        </div>
    </aside>

    <section class="signup-main" style="padding-top:40px;">
        <div class="container">

            @if(session('messege'))
                <div class="alert-success">{{ session('messege') }}</div>
            @endif

            <div class="row">
                {{-- معلومات المستخدم --}}
                <div class="col-12 col-lg-4">
                    <div class="profile-card" style="text-align:center;">
                        <div class="avatar-circle">{{ mb_substr($user->name, 0, 1) }}</div>
                        <h3 style="text-align:center;">{{ $user->name }}</h3>
                        <p style="color:#999; font-size:13px;">{{ $user->email }}</p>
                        <p style="color:#999; font-size:13px;">{{ $user->phone }}</p>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    {{-- تعديل البيانات --}}
                    <div class="profile-card">
                        <h3>{{ app()->getLocale() == 'ar' ? 'تعديل البيانات الشخصية' : 'Edit Profile' }}</h3>
                        <form method="POST" action="{{ route('patient.profile.update') }}">
                            @csrf
                            <label>{{ app()->getLocale() == 'ar' ? 'الاسم الكامل' : 'Full Name' }}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror

                            <label>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror

                            <label>{{ app()->getLocale() == 'ar' ? 'رقم الهاتف' : 'Phone' }}</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror

                            <button type="submit" class="btn-save">{{ app()->getLocale() == 'ar' ? 'حفظ التعديلات' : 'Save Changes' }}</button>
                        </form>
                    </div>

                    {{-- تغيير كلمة المرور --}}
                    <div class="profile-card">
                        <h3>{{ app()->getLocale() == 'ar' ? 'تغيير كلمة المرور' : 'Change Password' }}</h3>
                        <form method="POST" action="{{ route('patient.profile.password') }}">
                            @csrf
                            <label>{{ app()->getLocale() == 'ar' ? 'كلمة المرور الحالية' : 'Current Password' }}</label>
                            <input type="password" name="current_password" required>
                            @error('current_password')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror

                            <label>{{ app()->getLocale() == 'ar' ? 'كلمة المرور الجديدة' : 'New Password' }}</label>
                            <input type="password" id="new_password" name="password" required>
                            @include('components.password-strength', ['inputId' => 'new_password'])
                            @error('password')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror

                            <label>{{ app()->getLocale() == 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}</label>
                            <input type="password" name="password_confirmation" required>

                            <button type="submit" class="btn-save">{{ app()->getLocale() == 'ar' ? 'تغيير كلمة المرور' : 'Change Password' }}</button>
                        </form>
                    </div>

                    {{-- مواعيدي --}}
                    <div class="profile-card">
                        <h3>{{ app()->getLocale() == 'ar' ? 'مواعيدي' : 'My Appointments' }}</h3>
                        @if($orders->count())
                            <div style="overflow-x:auto;">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>{{ app()->getLocale() == 'ar' ? 'التاريخ' : 'Date' }}</th>
                                        <th>{{ app()->getLocale() == 'ar' ? 'الحالة' : 'Status' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->appointment_date ?? $order->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $order->status ?? 'pending' }}">
                                                {{ $order->status ?? (app()->getLocale() == 'ar' ? 'قيد الانتظار' : 'Pending') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        @else
                            <p style="color:#999; font-size:13px;">
                                {{ app()->getLocale() == 'ar' ? 'لا توجد مواعيد محجوزة بعد' : 'No appointments yet' }}
                            </p>
                        @endif
                    </div>
                    <div class="profile-card" style="border:1px solid #f8d7da;">
    <h3 style="color:#e74c3c;">
        {{ app()->getLocale() == 'ar' ? 'حذف الحساب' : 'Delete Account' }}
    </h3>
    <p style="color:#999; font-size:13px; margin-bottom:14px;">
        {{ app()->getLocale() == 'ar'
            ? 'سيتم حذف حسابك وجميع بياناتك بشكل نهائي. لا يمكن التراجع عن هذا الإجراء.'
            : 'Your account and all your data will be permanently deleted. This action cannot be undone.' }}
    </p>
    <form method="POST" action="{{ route('patient.profile.destroy') }}"
        onsubmit="return confirm('{{ app()->getLocale() == "ar" ? "هل أنت متأكد من حذف حسابك؟" : "Are you sure you want to delete your account?" }}')">
        @csrf
        <button type="submit" class="btn-save" style="background:#e74c3c;">
            <i class="fa-solid fa-trash"></i>
            {{ app()->getLocale() == 'ar' ? 'حذف حسابي' : 'Delete My Account' }}
        </button>
    </form>
</div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/vendor/font-awesome.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            var dd = document.querySelector('.patient-dropdown');
            var menu = document.getElementById('patientMenu');
            if (dd && menu && !dd.contains(e.target)) menu.classList.remove('show');
        });
    </script>
</body>
</html>
