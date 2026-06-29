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
    <title>{{ __('about_us') }}</title>

    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif

    <style>
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }

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

        /* ===== About page styles ===== */
        .about-intro { padding:60px 0 30px; }
        .about-intro h2 { font-size:28px; font-weight:700; color:#2c3e50; margin-bottom:16px; }
        .about-intro p { color:#666; font-size:15px; line-height:1.9; max-width:800px; }

        .about-stats { display:flex; flex-wrap:wrap; gap:20px; margin:30px 0 50px; }
        .about-stats .stat-box { flex:1; min-width:150px; background:#f8f9fa; border-radius:12px; padding:24px; text-align:center; }
        .about-stats .stat-box .num { font-size:30px; font-weight:700; color:#3498db; }
        .about-stats .stat-box .lbl { font-size:13px; color:#888; margin-top:6px; }

        .about-values { display:flex; flex-wrap:wrap; gap:24px; margin-bottom:60px; }
        .about-values .value-box { flex:1; min-width:240px; background:#fff; border:1px solid #eee; border-radius:12px; padding:28px; }
        .about-values .value-box i { font-size:28px; color:#3498db; margin-bottom:14px; display:block; }
        .about-values .value-box h4 { font-size:16px; font-weight:700; margin-bottom:8px; color:#2c3e50; }
        .about-values .value-box p { font-size:13px; color:#888; line-height:1.8; margin:0; }
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
                        <div class="logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></a></div>
                        <div class="m-logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></a></div>
                    </div>
                    <div class="p-center">
                        <nav>
                            <ul class="main-nav">
                                <li><a href="/">{{ __('site.home') }}</a></li>
                                <li><a href="{{ route('site.centers') }}">{{ __('site.clinics') }}</a></li>
                                <li><a href="{{ route('site.show') }}#Contact">{{ __('site.contact') }}</a></li>
                                <li><a href="{{ route('site.about') }}" class="active">{{ __('about_us') }}</a></li>
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
                <li><a href="{{ route('site.show') }}#Contact">{{ __('site.contact') }}</a></li>
                <li><a href="{{ route('site.about') }}">{{ __('about_us') }}</a></li>
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

    {{-- Page Banner --}}
    <section class="page-banner-s1">
        <div class="container">
            <div class="row">
                <div class="p-banner-inner">
                    <h1 class="s-title">{{ __('about_us') }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('site.show') }}">{{ __('site.home') }}</a></li>
                        <li><a href="#">{{ __('about_us') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shapes">
            <ul class="animated-boxes-l animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li></ul>
            <ul class="animated-boxes-r animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li></ul>
        </div>
    </section>

    {{-- Content --}}
    <section class="about-intro">
        <div class="container">
            <h2>
                {{ app()->getLocale() == 'ar' ? 'منصتك الموثوقة لحجز المواعيد الطبية' : 'Your Trusted Platform for Medical Appointments' }}
            </h2>
            <p>
                {{ app()->getLocale() == 'ar'
                    ? 'نسعى لتسهيل الوصول إلى الرعاية الصحية من خلال ربط المرضى بالعيادات والمراكز الطبية الموثقة في مكان واحد. يمكنك تصفح العيادات حسب التخصص أو المدينة، والاطلاع على تقييمات المرضى الحقيقية، وحجز موعدك بكل سهولة وأمان.'
                    : 'We aim to make healthcare more accessible by connecting patients with verified medical clinics and centers in one place. Browse clinics by specialty or city, read genuine patient reviews, and book your appointment easily and securely.' }}
            </p>

            <div class="about-stats">
                <div class="stat-box">
                    <div class="num">{{ \App\Models\Center::active()->count() }}+</div>
                    <div class="lbl">{{ app()->getLocale() == 'ar' ? 'عيادة مسجلة' : 'Registered Clinics' }}</div>
                </div>
                <div class="stat-box">
                    <div class="num">{{ \App\Models\User::count() }}+</div>
                    <div class="lbl">{{ app()->getLocale() == 'ar' ? 'مستخدم' : 'Users' }}</div>
                </div>
                <div class="stat-box">
                    <div class="num">{{ \App\Models\Category::active()->count() }}+</div>
                    <div class="lbl">{{ app()->getLocale() == 'ar' ? 'تخصص طبي' : 'Medical Specialties' }}</div>
                </div>
                <div class="stat-box">
                    <div class="num">{{ \App\Models\City::active()->count() }}+</div>
                    <div class="lbl">{{ app()->getLocale() == 'ar' ? 'مدينة' : 'Cities Covered' }}</div>
                </div>
            </div>

            <div class="about-values">
                <div class="value-box">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h4>{{ app()->getLocale() == 'ar' ? 'عيادات موثقة' : 'Verified Clinics' }}</h4>
                    <p>
                        {{ app()->getLocale() == 'ar'
                            ? 'كل عيادة على المنصة تمر بعملية تحقق من ترخيصها الرسمي قبل الظهور للمرضى.'
                            : 'Every clinic on the platform goes through a license verification process before appearing to patients.' }}
                    </p>
                </div>
                <div class="value-box">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h4>{{ app()->getLocale() == 'ar' ? 'حجز سهل وسريع' : 'Easy & Fast Booking' }}</h4>
                    <p>
                        {{ app()->getLocale() == 'ar'
                            ? 'اختر العيادة والخدمة المناسبة واحجز موعدك في دقائق معدودة من أي جهاز.'
                            : 'Choose the right clinic and service, and book your appointment in minutes from any device.' }}
                    </p>
                </div>
                <div class="value-box">
                    <i class="fa-solid fa-star"></i>
                    <h4>{{ app()->getLocale() == 'ar' ? 'تقييمات حقيقية' : 'Genuine Reviews' }}</h4>
                    <p>
                        {{ app()->getLocale() == 'ar'
                            ? 'تقييمات وآراء من مرضى حقيقيين زاروا العيادة، تساعدك على اتخاذ القرار الصحيح.'
                            : 'Ratings and reviews from real patients who visited the clinic, helping you make the right choice.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-s1 footer-s2">
        <div class="container">
            <div class="footer-subs-s2">
                <div class="footer-sub-s2-inner">
                    <h3 class="s-title" data-aos="fade-up">{{ __('site.subscribe_title') }}</h3>
                    <p data-aos="fade-up" data-aos-delay="50">{{ __('site.subscribe_desc') }}</p>
                    <div class="subs-form-s1" data-aos="fade-up" data-aos-delay="50">
                        <input type="text" placeholder="{{ __('site.subscribe_ph') }}" />
                        <button class="btn-frm" type="submit">{{ __('site.subscribe_btn') }}</button>
                    </div>
                </div>
            </div>
            <div class="footer-m-wrap">
                <div class="f-widget widget-1">
                    <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG') }}" alt /></div>
                    <ul class="f-menu">
                        <li><a href="#">{{ __('site.footer_track') }}</a></li>
                        <li><a href="#">{{ __('site.footer_delivery') }}</a></li>
                        <li><a href="#">{{ __('site.footer_warranty') }}</a></li>
                    </ul>
                </div>
                <div class="f-widget widget-2">
                    <h4 class="w-title">{{ __('site.footer_about') }}</h4>
                    <ul class="f-menu">
                        <li><a href="{{ route('site.about') }}">{{ __('about_us') }}</a></li>
                        <li><a href="#">{{ __('site.footer_work') }}</a></li>
                        <li><a href="#">{{ __('site.footer_news') }}</a></li>
                        <li><a href="#">{{ __('site.footer_investors') }}</a></li>
                    </ul>
                </div>
                <div class="f-widget widget-3">
                    <h4 class="w-title">{{ __('site.clinics') }}</h4>
                    <ul class="f-menu">
                        <li><a href="{{ route('site.centers') }}">{{ __('site.view_all_clinics') }}</a></li>
                    </ul>
                </div>
                <div class="f-widget widget-4">
                    <h4 class="w-title">{{ __('site.contact_title') }}</h4>
                    <p>{{ __('site.contact_desc') }}</p>
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
    </script>
</body>
</html>
