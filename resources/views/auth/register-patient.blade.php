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
    <title>{{ app()->getLocale() == 'ar' ? 'تسجيل مريض جديد' : 'Patient Registration' }}</title>

    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif

    <style>
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }
        .password-wrapper { position:relative; display:flex; align-items:center; }
        .password-wrapper input { width:100%; padding-inline-end:40px; }
        .toggle-password { position:absolute; inset-inline-end:10px; background:none; border:none; cursor:pointer; color:#7f8c8d; font-size:16px; }
        .toggle-password:hover { color:#3498db; }

        .patient-dropdown-menu { display:none; position:absolute; left:0; top:100%; background:#fff; border-radius:8px; box-shadow:0 4px 16px rgba(0,0,0,0.12); min-width:160px; z-index:9999; overflow:hidden; }
        .patient-dropdown-menu.show { display:block; }
        .patient-dropdown-menu a { display:block; padding:10px 16px; color:#333; font-size:13px; text-decoration:none; }
        .patient-dropdown-menu a:hover { background:#f5f5f5; }
        .patient-dropdown-menu a.logout { color:#e74c3c; border-top:1px solid #f0f0f0; }

        .m-nav-auth { display:flex; flex-direction:column; gap:10px; margin-top:20px; padding:16px 15px 20px; border-top:1px solid #eee; }
        .m-nav-auth a { display:block; padding:9px 14px; border-radius:6px; font-size:13px; font-weight:600; text-align:center; text-decoration:none; }
        .m-nav-auth .btn-login { border:1px solid #ddd; color:#333; }
        .m-nav-auth .btn-reg { background:#3498db; color:#fff; }
        .m-nav-auth .btn-dash { border:1px solid #ddd; color:#333; }
    </style>
</head>

<body id="home2">
    <div id="preloader">
        <div class="preloader-container">
            <div class="item item-1"></div>
            <div class="item item-2"></div>
            <div class="item item-3"></div>
            <div class="item item-4"></div>
        </div>
    </div>

    <header class="header accent-lightBlue">
        <div class="h-bottom-container">
            <div class="container-stretch">
                <div class="h-bottom-inner">
                    <div class="p-left">
                        <div class="logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></a></div>
                        <div class="m-logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></a></div>
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

                    <div class="p-right" style="display:flex; align-items:center; gap:8px;">
                        @auth
                            @if(auth()->user()->role === 'patient')
                                <div style="position:relative;" class="patient-dropdown">
                                    <button type="button" onclick="document.getElementById('patientMenu').classList.toggle('show')"
                                        style="background:transparent; border:1px solid #ddd; border-radius:6px; color:#333; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; padding:6px 12px; font-size:13px;">
                                        <i class="fa-solid fa-user-circle"></i>
                                        {{ auth()->user()->name }}
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
                            @else
                                <a href="{{ url('/dashboard') }}" style="font-size:13px; font-weight:600; color:#333; padding:6px 14px; border:1px solid #ddd; border-radius:6px; white-space:nowrap; text-decoration:none;">
                                    {{ __('site.dashboard') }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" style="font-size:13px; font-weight:600; color:#333; padding:6px 14px; border:1px solid #ddd; border-radius:6px; white-space:nowrap; text-decoration:none;">
                                {{ __('site.login') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" style="font-size:13px; font-weight:600; color:#fff; background:#3498db; padding:6px 14px; border-radius:6px; white-space:nowrap; text-decoration:none;">
                                    {{ __('site.register') }}
                                </a>
                            @endif
                        @endauth

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
            <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></div>
            <ul class="main-nav">
                <li><a href="/">{{ __('site.home') }}</a></li>
                <li><a href="{{ route('site.centers') }}">{{ __('site.clinics') }}</a></li>
                <li><a href="/">{{ __('site.blog') }}</a></li>
                <li><a href="#Contact">{{ __('site.contact') }}</a></li>
            </ul>

            <div class="m-nav-auth">
                @auth
                    @if(auth()->user()->role === 'patient')
                        <a href="{{ route('patient.profile') }}" class="btn-login">
                            <i class="fa-solid fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <a href="javascript:;" onclick="document.getElementById('m-logout-form').submit();" class="btn-login" style="color:#e74c3c;">
                            {{ app()->getLocale() == 'ar' ? 'تسجيل خروج' : 'Logout' }}
                        </a>
                        <form id="m-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                    @else
                        <a href="{{ url('/dashboard') }}" class="btn-dash">{{ __('site.dashboard') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-login">{{ __('site.login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-reg">{{ __('site.register') }}</a>
                    @endif
                @endauth
                <form action="{{ route('locale.switch') }}" method="POST">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">
                    <button type="submit" class="lang-btn" style="width:100%;">{{ __('site.language') }}</button>
                </form>
            </div>
        </div>
    </aside>

    <section class="signup-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login-main__form">
                        <form method="POST" action="{{ route('patient.register.store') }}" class="form">
                            @csrf
                            <h3 class="frm-header">
                                {{ app()->getLocale() == 'ar' ? 'إنشاء حساب مريض' : 'Create Patient Account' }}
                            </h3>
                            <p style="text-align:center; font-size:13px; color:#7f8c8d; margin-bottom:16px;">
                                {{ app()->getLocale() == 'ar' ? 'سجل حسابك لحجز المواعيد الطبية' : 'Register your account to book appointments' }}
                            </p>

                            <div class="inner-wrap">
                                <div class="s-input">
                                    <label>{{ app()->getLocale() == 'ar' ? 'الاسم الكامل' : 'Full Name' }}*</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                        placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}" />
                                    @error('name')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                </div>

                                <div class="s-input">
                                    <label>{{ app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email' }}*</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email' }}" />
                                    @error('email')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                </div>

                                <div class="s-input">
                                    <label>{{ app()->getLocale() == 'ar' ? 'رقم الهاتف' : 'Phone Number' }}*</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required
                                        placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل رقم الهاتف' : 'Enter phone number' }}" />
                                    @error('phone')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                </div>

                                <div class="input-grp">
                                    <div class="s-input">
                                        <label>{{ app()->getLocale() == 'ar' ? 'كلمة المرور' : 'Password' }}*</label>
                                        <div class="password-wrapper">
                                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="********" />
                                            <button type="button" class="toggle-password" data-target="password"><i class="fa-regular fa-eye"></i></button>
                                        </div>
                                        @include('components.password-strength', ['inputId' => 'password'])
                                        @error('password')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input">
                                        <label>{{ app()->getLocale() == 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}*</label>
                                        <div class="password-wrapper">
                                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="********" />
                                            <button type="button" class="toggle-password" data-target="password_confirmation"><i class="fa-regular fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-grp">
                                    <div class="s-input">
                                        <label><input type="checkbox" name="remember"> {{ app()->getLocale() == 'ar' ? 'تذكرني' : 'Remember Me' }}</label>
                                    </div>
                                </div>

                                <div class="f-bottom">
                                    <button class="btn btn-s2 btn-lg" type="submit">
                                        {{ app()->getLocale() == 'ar' ? 'إنشاء الحساب' : 'Create Account' }}
                                    </button>
                                    <p>
                                        {{ app()->getLocale() == 'ar' ? 'لديك حساب بالفعل؟' : 'Already have an account?' }}
                                        <a href="{{ route('login') }}">{{ app()->getLocale() == 'ar' ? 'تسجيل الدخول' : 'Login' }}</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="shapes">
            <ul class="animated-boxes-l animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li></ul>
            <ul class="animated-boxes-r animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li></ul>
        </div>
    </section>

    <footer class="footer-s1 footer-s2">
        <div class="container">
            <div class="footer-subs-s2">
                <div class="footer-sub-s2-inner">
                    <h3 class="s-title">{{ __('site.subscribe_title') }}</h3>
                    <p>{{ __('site.subscribe_desc') }}</p>
                    <div class="subs-form-s1">
                        <input type="text" placeholder="{{ __('site.subscribe_ph') }}" />
                        <button class="btn-frm" type="submit">{{ __('site.subscribe_btn') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-stretch">
            <div class="f-copy-right">
                <div class="p-left">
                    <ul class="s-links">
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                    <p class="cr-text">©{{ date('Y') }} {{ __('site.footer_rights') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/font-awesome.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/aos.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            var dd = document.querySelector('.patient-dropdown');
            var menu = document.getElementById('patientMenu');
            if (dd && menu && !dd.contains(e.target)) menu.classList.remove('show');
        });
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                var icon = this.querySelector('i');
                if (input.type === 'password') { input.type = 'text'; icon.classList.replace('fa-eye', 'fa-eye-slash'); }
                else { input.type = 'password'; icon.classList.replace('fa-eye-slash', 'fa-eye'); }
            });
        });
    </script>
</body>
</html>
