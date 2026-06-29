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
    <title>{{ $center->center_name ?? __('site.clinics') }}</title>

    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    @endif

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close-btn {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            float: right;
            cursor: pointer;
        }

        .lang-btn {
            background: transparent;
            border: 1.5px solid #3498db;
            color: #3498db;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 13px;
            cursor: pointer;
            font-weight: 500;
        }

        .lang-btn:hover {
            background: #3498db;
            color: #fff;
        }

        .license-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: linear-gradient(135deg, #1a7f3c, #25a550);
            color: #fff;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 8px;
            box-shadow: 0 2px 6px rgba(37, 165, 80, 0.3);
        }

        .license-badge i {
            font-size: 12px;
        }

        .login-required-box {
            text-align: center;
            padding: 50px 20px;
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            margin: 20px 0;
        }

        .login-required-box i {
            font-size: 50px;
            color: #ccc;
            margin-bottom: 16px;
            display: block;
        }

        .login-required-box h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #333;
        }

        .login-required-box p {
            color: #888;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .login-required-box .btn-register {
            display: inline-block;
            background: linear-gradient(135deg, #6a0dad, #e91e8c);
            color: #fff;
            padding: 10px 28px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            margin: 4px;
        }

        .login-required-box .btn-login {
            display: inline-block;
            background: transparent;
            color: #6a0dad;
            padding: 9px 24px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border: 1.5px solid #6a0dad;
            margin: 4px;
        }

        .login-required-box .btn-login:hover {
            background: #6a0dad;
            color: #fff;
        }

        .patient-dropdown-menu {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            min-width: 160px;
            z-index: 9999;
            overflow: hidden;
        }

        .patient-dropdown-menu.show {
            display: block;
        }

        .patient-dropdown-menu a {
            display: block;
            padding: 10px 16px;
            color: #333;
            font-size: 13px;
            text-decoration: none;
        }

        .patient-dropdown-menu a:hover {
            background: #f5f5f5;
        }

        .patient-dropdown-menu a.logout {
            color: #e74c3c;
            border-top: 1px solid #f0f0f0;
        }

        .m-nav-auth {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            padding: 16px 15px 20px;
            border-top: 1px solid #eee;
        }

        .m-nav-auth a {
            display: block;
            padding: 9px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .m-nav-auth .btn-login {
            border: 1px solid #ddd;
            color: #333;
        }

        .m-nav-auth .btn-reg {
            background: #3498db;
            color: #fff;
        }

        .m-nav-auth .btn-dash {
            border: 1px solid #ddd;
            color: #333;
        }

        /* ===== Rating styles ===== */
        .rating-summary {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        .rating-summary .stars {
            color: #f1c40f;
            font-size: 16px;
        }

        .rating-summary .avg {
            font-size: 13px;
            color: #666;
            font-weight: 600;
        }

        .rating-summary .count {
            font-size: 12px;
            color: #999;
        }

        .rating-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .rating-box h4 {
            font-size: 15px;
            margin-bottom: 12px;
        }

        #star-rating {
            font-size: 28px;
            color: #ddd;
            cursor: pointer;
            display: flex;
            gap: 4px;
            margin-bottom: 12px;
        }

        .rating-box textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            font-size: 13px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .review-item {
            border-bottom: 1px solid #eee;
            padding: 14px 0;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-item .stars {
            color: #f1c40f;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .review-item p {
            font-size: 13px;
            color: #555;
            margin: 4px 0;
            word-break: break-word;
        }

        .review-item .meta {
            font-size: 11px;
            color: #aaa;
        }

        .login-to-rate {
            font-size: 13px;
            color: #999;
            margin-top: 0;
        }

        /* ===================== RESPONSIVE FIXES ===================== */

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .h-bottom-inner .p-right {
            flex-wrap: nowrap;
        }

        /* إخفاء أزرار سطح المكتب على الموبايل/التابلت (مكررة في القائمة الجانبية) */
        @media (max-width: 991px) {
            .desktop-auth-actions {
                display: none !important;
            }

            .h-bottom-inner .p-right {
                gap: 6px !important;
            }
        }

        /* تبويبات الصفحة (نظرة عامة / خدمات / حجز / تقييمات) قابلة للتمرير أفقياً على الموبايل */
        @media (max-width: 575px) {
            .profile-tab-links .tab-links {
                max-width: 100% !important;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                flex-wrap: nowrap;
                white-space: nowrap;
            }

            .profile-tab-links .tab-links .tab-btn {
                flex: 0 0 auto;
            }
        }

        /* تصغير حجم النجوم في فورم التقييم على الشاشات الصغيرة */
        @media (max-width: 420px) {
            #star-rating {
                font-size: 22px;
            }

            .rating-summary .stars {
                font-size: 14px;
            }
        }

        /* ضبط الفورم وحقوله ليأخذوا العرض الكامل */
        @media (max-width: 575px) {
            .input-grp.row {
                margin: 0;
            }

            .input-grp.row .s-input.col-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 420px) {
            .lang-btn {
                padding: 4px 8px;
                font-size: 11px;
            }
        }
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

                        <div class="desktop-auth-actions" style="display:flex; align-items:center; gap:8px;">
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
                        </div>

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

    {{-- Banner --}}
    <section class="profile-banner-s1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile-banner-inner">
                        <div class="thumb">
                            <img src="{{ asset('storage/files/' . $center->center_logo ?? '') }}" alt />
                        </div>
                        <div class="content">
                            <h1 class="name">{{ $center->center_name ?? '' }}</h1>
                            <ul class="catagories">
                                <p>{{ $center->center_address ?? '' }}</p>
                            </ul>
                            <div class="rating">
                                <div class="rating-text">
                                    <p>{{ $center->phone ?? '' }}</p>
                                </div>
                            </div>

                            <div class="rating-summary">
                                <div class="stars">
                                    @php $avg = $center->avgRating(); @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=floor($avg))
                                        <i class="fa-solid fa-star"></i>
                                        @elseif($i - $avg < 1 && $i - $avg> 0)
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                            @else
                                            <i class="fa-regular fa-star"></i>
                                            @endif
                                            @endfor
                                </div>
                                <span class="avg">{{ $avg > 0 ? $avg : '0.0' }}</span>
                                <span class="count">
                                    ({{ $center->ratingsCount() }} {{ app()->getLocale() == 'ar' ? 'تقييم' : 'ratings' }})
                                </span>
                            </div>

                            @if($center->license_status == 'approved')
                            <div class="license-badge">
                                <i class="fa-solid fa-shield-halved"></i>
                                {{ app()->getLocale() == 'ar' ? 'مرخصة من وزارة الصحة' : 'Licensed by Ministry of Health' }}
                            </div>
                            @endif
                        </div>
                        <div class="shapes">
                            <ul class="animated-boxes-l animated-boxes">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <ul class="animated-boxes-r animated-boxes">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tabs --}}
    <section class="profile-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile-tab-links">
                        <div class="tab-links" data-links-for="profile-tabs" style="max-width:600px;">
                            <button class="tab-btn active" data-tab="overview">
                                <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                                <span class="text">{{ __('site.overview') }}</span>
                            </button>
                            <button class="tab-btn" data-tab="portfolio">
                                <span class="icon"><i class="fa-solid fa-box"></i></span>
                                <span class="text">{{ __('site.services') }}</span>
                            </button>
                            <button class="tab-btn" data-tab="file">
                                <span class="icon"><i class="fa-solid fa-file"></i></span>
                                <span class="text">{{ __('site.book_appointment') }}</span>
                            </button>
                            <button class="tab-btn" data-tab="reviews">
                                <span class="icon"><i class="fa-solid fa-star"></i></span>
                                <span class="text">{{ app()->getLocale() == 'ar' ? 'التقييمات' : 'Reviews' }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="profile-tab">
                        <div class="tab tab-s1" id="profile-tabs">
                            <div class="tab-contents">

                                {{-- Overview --}}
                                <div class="tab-pane active" id="overview">
                                    <div class="tab-p-inner">
                                        <div class="overview">
                                            <div>{!! $center->overview ?? '' !!}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Services --}}
                                <div class="tab-pane" id="portfolio">
                                    <div class="tab-p-inner">
                                        <div class="portfolio">
                                            @foreach ($center->services as $service)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="pro-box-s1">
                                                    <div class="content">
                                                        <h4 class="p-title">{{ $service->name ?? '' }}</h4>
                                                        <p class="p-meta">{{ $service->description ?? '' }}</p>
                                                        <div class="download-rating-wrap">
                                                            <div class="p-left">
                                                                <a href="#" class="d-btn">
                                                                    <span class="sale-count">{{ $service->duration ?? '' }}</span>
                                                                    <i class="fa-solid fa-clock"></i>
                                                                    {{ $service->price }} {{ $center->currency->name ?? '' }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Booking Form --}}
                                <div class="tab-pane" id="file">
                                    <div class="tab-p-inner">
                                        <div class="file">
                                            @guest
                                            <div class="login-required-box">
                                                <i class="fa-solid fa-lock"></i>
                                                <h4>{{ app()->getLocale() == 'ar' ? 'يجب التسجيل أولاً' : 'Registration Required' }}</h4>
                                                <p>{{ app()->getLocale() == 'ar' ? 'يجب أن يكون لديك حساب مريض لتتمكن من حجز موعد' : 'You need a patient account to book an appointment' }}</p>
                                                <a href="{{ route('patient.register') }}" class="btn-register">
                                                    {{ app()->getLocale() == 'ar' ? 'إنشاء حساب' : 'Create Account' }}
                                                </a>
                                                <a href="{{ route('login') }}" class="btn-login">
                                                    {{ app()->getLocale() == 'ar' ? 'تسجيل الدخول' : 'Login' }}
                                                </a>
                                            </div>
                                            @else
                                            <form method="POST" action="{{ route('site.order') }}" class="form">
                                                @csrf
                                                <input type="hidden" name="center_id" value="{{ $center->id }}" />
                                                <div class="s-input">
                                                    <label for="name">{{ __('site.patient_name') }}*</label>
                                                    <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('site.patient_name') }}" />
                                                    @error('name')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="s-input">
                                                    <label for="email">{{ __('site.patient_email') }}</label>
                                                    <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('site.patient_email') }}" />
                                                    @error('email')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="s-input">
                                                    <label for="phone">{{ __('site.patient_phone') }}*</label>
                                                    <input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}" required placeholder="{{ __('site.patient_phone') }}" />
                                                    @error('phone')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="input-grp row">
                                                    <div class="s-input col-3">
                                                        <label for="service_id">{{ __('site.service_lbl') }}</label>
                                                        <select id="service_id" class="block mt-1 w-full" name="service_id">
                                                            <option value="" disabled selected>{{ __('site.select_service') }}</option>
                                                            @foreach ($center->services as $servic)
                                                            <option value="{{ $servic->id }}" {{ old('service_id') == $servic->id ? 'selected' : '' }}>{{ $servic->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="s-input col-3">
                                                        <label for="gender">{{ __('site.patient_gender') }}</label>
                                                        <select id="gender" class="block mt-1 w-full" name="gender">
                                                            <option value="">{{ __('site.select_gender') }}</option>
                                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('site.male') }}</option>
                                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('site.female') }}</option>
                                                        </select>
                                                        @error('gender')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="s-input">
                                                    <label for="appointment_date">{{ __('site.appointment_date') }}</label>
                                                    <input id="appointment_date" class="block mt-1 w-full" type="date" name="appointment_date" value="{{ old('appointment_date') }}" />
                                                    @error('appointment_date')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="s-input">
                                                    <label for="notes">{{ __('site.notes') }}</label>
                                                    <textarea id="notes" class="block mt-1 w-full" name="notes" placeholder="{{ __('site.notes_ph') }}">{{ old('notes') }}</textarea>
                                                    @error('notes')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>
                                                <div class="f-bottom">
                                                    <button type="submit" class="btn btn-primary">{{ __('site.submit') }}</button>
                                                </div>
                                            </form>
                                            @endguest
                                        </div>
                                    </div>
                                </div>

                                {{-- Reviews Tab --}}
                                <div class="tab-pane" id="reviews">
                                    <div class="tab-p-inner">

                                        @auth
                                        @if(auth()->user()->role === 'patient')
                                        @php
                                        $myRating = \App\Models\Rating::where('user_id', auth()->id())
                                        ->where('center_id', $center->id)
                                        ->first();
                                        @endphp

                                        <div class="rating-box">
                                            <h4>
                                                {{ $myRating
                                                            ? (app()->getLocale() == 'ar' ? 'تعديل تقييمك لهذه العيادة' : 'Edit your rating for this clinic')
                                                            : (app()->getLocale() == 'ar' ? 'قيّم هذه العيادة' : 'Rate this clinic') }}
                                            </h4>

                                            <form method="POST" action="{{ route('rating.store') }}">
                                                @csrf
                                                <input type="hidden" name="center_id" value="{{ $center->id }}">
                                                <input type="hidden" name="rating" id="stars-input" value="{{ $myRating->rating ?? 0 }}">

                                                <div id="star-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="star-item" data-value="{{ $i }}"
                                                        style="color:{{ $myRating && $i <= $myRating->rating ? '#f1c40f' : '#ddd' }};">
                                                        <i class="fa-solid fa-star"></i>
                                                        </span>
                                                        @endfor
                                                </div>

                                                <textarea name="comment" rows="3"
                                                    placeholder="{{ app()->getLocale() == 'ar' ? 'اكتب تعليقك (اختياري)' : 'Write a comment (optional)' }}">{{ $myRating->comment ?? '' }}</textarea>

                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    {{ app()->getLocale() == 'ar' ? 'إرسال التقييم' : 'Submit Rating' }}
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                        @endauth

                                        @guest
                                        <p class="login-to-rate">
                                            {{ app()->getLocale() == 'ar'
                                                    ? 'سجّل دخولك كمريض لتتمكن من تقييم هذه العيادة'
                                                    : 'Login as a patient to rate this clinic' }}
                                        </p>
                                        @endguest

                                        @php
                                        $reviews = $center->ratings()
                                        ->where('status', 'active')
                                        ->whereNotNull('comment')
                                        ->where('comment', '!=', '')
                                        ->latest()
                                        ->get();
                                        @endphp

                                        @if($reviews->count())
                                        <h4 style="font-size:15px; margin:20px 0 8px;">
                                            {{ app()->getLocale() == 'ar' ? 'آراء المرضى' : 'Patient Reviews' }}
                                        </h4>
                                        @foreach($reviews as $r)
                                        <div class="review-item">
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-{{ $i <= $r->rating ? 'solid' : 'regular' }} fa-star"></i>
                                                    @endfor
                                            </div>
                                            <p>{{ $r->comment }}</p>
                                            <span class="meta">{{ $r->user->name ?? '' }} — {{ $r->created_at->diffForHumans() }}</span>
                                        </div>
                                        @endforeach
                                        @else
                                        <p style="font-size:13px; color:#999; margin-top:16px;">
                                            {{ app()->getLocale() == 'ar' ? 'لا توجد تقييمات بعد' : 'No reviews yet' }}
                                        </p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="profile-sidebar">
                        <div class="selling-info widget">
                            <h3 class="w-title">{{ __('site.category') }}</h3>
                            <ul class="i-list-s2">
                                <li><span class="count">{{ $center->category->name ?? '' }}</span></li>
                            </ul>
                        </div>
                        <div class="personal-info widget">
                            <h3 class="w-title">{{ __('site.personal_info') }}</h3>
                            <ul>
                                <li>
                                    <span class="field">{{ __('site.country') }}</span>
                                    <span class="value">{{ $center->country->name ?? '' }}</span>
                                </li>
                                <li>
                                    <span class="field">{{ __('site.city') }}</span>
                                    <span class="value">{{ $center->city->name ?? '' }}</span>
                                </li>
                                <li>
                                    <span class="field">{{ __('site.member_since') }}</span>
                                    <span class="value">{{ $center->created_at->format('M/Y') }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="socials widget">
                            <h3 class="w-title">{{ __('site.social_profile') }}</h3>
                            <ul class="social-links">
                                <li><a href="{{ $center->facebook_url ?? '#' }}"><img src="{{ asset('assets/images/icons/Facebook.png') }}" alt /></a></li>
                                <li><a href="{{ $center->youtube_url ?? '#' }}"><img style="width:45px;height:45px;border-radius:50%;" src="{{ asset('assets/images/icons/whatsapp.jpg') }}" alt /></a></li>
                                <li><a href="{{ $center->instagram_url ?? '#' }}"><img style="width:45px;height:45px;border-radius:50%;" src="{{ asset('assets/images/icons/insta.jpg') }}" alt /></a></li>
                                <li><a href="{{ $center->twitter_url ?? '#' }}"><img src="{{ asset('assets/images/icons/Twitter.png') }}" alt /></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <p style="color: rgb(8, 187, 32)">{{ session('success') }}</p>
        </div>
    </div>

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
                        <li><a href="#">{{ __('site.footer_story') }}</a></li>
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
                <div class="p-right">
                    <a href="#"><img src="{{ asset('assets/images/thumbs/p-gateway-img.png') }}" alt /></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/font-awesome.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/aos.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/scrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            var dd = document.querySelector('.patient-dropdown');
            var menu = document.getElementById('patientMenu');
            if (dd && menu && !dd.contains(e.target)) menu.classList.remove('show');
        });

        function openModal() {
            document.getElementById('simpleModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('simpleModal').style.display = "none";
        }
        @if(session('success')) openModal();
        @endif

        document.addEventListener('click', function(e) {
            var star = e.target.closest('.star-item');
            if (!star) return;

            var value = parseInt(star.dataset.value);
            var input = document.getElementById('stars-input');
            if (!input) return;

            input.value = value;

            document.querySelectorAll('#star-rating .star-item').forEach(function(s) {
                s.style.color = parseInt(s.dataset.value) <= value ? '#f1c40f' : '#ddd';
            });
        });

        document.addEventListener('mouseover', function(e) {
            var star = e.target.closest('.star-item');
            if (!star) return;

            var value = parseInt(star.dataset.value);
            document.querySelectorAll('#star-rating .star-item').forEach(function(s) {
                s.style.color = parseInt(s.dataset.value) <= value ? '#f39c12' : '#ddd';
            });
        });

        document.addEventListener('mouseout', function(e) {
            var box = document.getElementById('star-rating');
            if (!box) return;
            var star = e.target.closest('.star-item');
            if (star && !box.contains(e.relatedTarget)) {
                var input = document.getElementById('stars-input');
                var current = parseInt(input.value) || 0;
                document.querySelectorAll('#star-rating .star-item').forEach(function(s) {
                    s.style.color = parseInt(s.dataset.value) <= current ? '#f1c40f' : '#ddd';
                });
            }
        });
    </script>
</body>

</html>
