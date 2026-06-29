<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.css')}}" />
    <script src="{{ asset('assets/js/preloader.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/aos.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <title>{{ __('site.hero_title') }}</title>

    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .main-nav li a {
            letter-spacing: 0;
        }
    </style>
    @endif

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
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

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
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

        /* قائمة المريض المنسدلة */
        .patient-dropdown-menu {
            display: none;
            position: absolute;

                {
                    {
                    app()->getLocale()=='ar' ? 'right': 'left'
                }
            }

            :0;
            top:100%;
            background:#fff;
            border-radius:8px;
            box-shadow:0 4px 16px rgba(0, 0, 0, 0.12);
            min-width:160px;
            z-index:9999;
            overflow:hidden;
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

        /* أزرار الموبايل في الـ aside */
        .m-nav-auth {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            padding: 0 15px 20px;
            border-top: 1px solid #eee;
            padding-top: 16px;
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

        /* ===================== RESPONSIVE FIXES ===================== */

        /* p-right: لا يضيق ولا يلتف بشكل عشوائي */
        .h-bottom-inner .p-right {
            flex-wrap: nowrap;
        }

        /* إخفاء أزرار سطح المكتب (دخول/تسجيل/داشبورد/قائمة المريض/اللغة)
           على الشاشات الصغيرة، لأنها موجودة بالفعل داخل القائمة الجانبية (aside) */
        @media (max-width: 991px) {
            .desktop-auth-actions {
                display: none !important;
            }

            .h-bottom-inner .p-right {
                gap: 6px !important;
            }
        }

        /* الخريطة (iframe) متجاوبة بالكامل */
        .map-wrap {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* نسبة 16:9 */
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        .map-wrap iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }

        /* صناديق التواصل تلتف بشكل صحيح على الموبايل */
        @media (max-width: 575px) {
            .contact-boxes-wrap {
                flex-direction: column;
            }

            .c-box.map {
                width: 100%;
            }
        }

        /* منع overflow أفقي عام */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* تصغير العناصر داخل p-right على الشاشات الصغيرة جداً */
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
                        <div class="logo">
                            <a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a>
                        </div>
                        <div class="m-logo">
                            <a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a>
                        </div>
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

                    {{-- ✅ p-right: الأزرار + اللغة + زر الموبايل --}}
                    <div class="p-right" style="display:flex; align-items:center; gap:8px;">

                        {{-- هذه الأزرار تظهر فقط على الشاشات الكبيرة (≥992px)
                             لأنها مكررة داخل القائمة الجانبية m-nav-auth --}}
                        <div class="desktop-auth-actions" style="display:flex; align-items:center; gap:8px;">
                            @auth
                            @if(auth()->user()->role === 'patient')
                            {{-- قائمة منسدلة للمريض --}}
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
                            {{-- داشبورد للعيادة أو الأدمن --}}
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
            <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></div>
            <ul class="main-nav">
                <li><a href="/">{{ __('site.home') }}</a></li>
                <li><a href="{{route('site.centers')}}">{{ __('site.clinics') }}</a></li>
                <li><a href="/">{{ __('site.blog') }}</a></li>
                <li><a href="#Contact">{{ __('site.contact') }}</a></li>
            </ul>

            {{-- ✅ أزرار الموبايل --}}
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

    {{-- Hero --}}
    <section class="hero-s2 s-padding">
        <div class="container-stretch">
            <div class="row">
                <div class="col-xl-6 col-lg-7 d-flex align-items-center">
                    <div class="hero-s2__content">
                        <h1 class="h-title">{{ __('site.hero_title') }}</h1>
                        <p class="h-desc">{{ __('site.hero_subtitle') }}</p>
                        <form action="{{route('site.centers')}}">
                            @csrf
                            <div class="s-bar-s1 accent-lightBlue">
                                <div class="s-bar-inner">
                                    <div class="p-left">
                                        <select name="category_id">
                                            <option value="">{{ __('site.all_categories') }}</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="search" placeholder="{{ __('site.search_placeholder') }}" />
                                    </div>
                                    <div class="p-right">
                                        <button type="submit" class="btn-frm-s2">
                                            <i class="fa-solid fa-magnifying-glass"></i>{{ __('site.search_btn') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="counter-sm">
                            <div class="s-counter">
                                <p class="number"><span class="counter-number">{{ $centersCount }}</span></p>
                                <p class="text">{{ __('site.stat_clinic') }}</p>
                            </div>
                            <div class="s-counter">
                                <p class="number"><span class="counter-number">{{ $usersCount }}</span></p>
                                <p class="text">{{ __('site.stat_user') }}</p>
                            </div>
                        </div>
                        <img class="shape" src="{{ asset('assets/images/shapes/hero-2-sm.png')}}" alt />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="hero-s2__thumb">
                        <img src="{{ asset('assets/images/a2.PNG')}}" alt />
                    </div>
                </div>
            </div>
        </div>
        <div class="shapes"><img src="{{ asset('assets/images/shapes/hero-2.png')}}" alt /></div>
    </section>

    {{-- Categories --}}
    <section class="s-padding catagories-sec-s1 accent-lightBlue">
        <div class="container">
            <div class="s-title-wrap">
                <p class="s-sub-title">{{ __('site.cat_subtitle') }}</p>
                <h2 class="s-title">{{ __('site.cat_title') }}</h2>
            </div>
            <div class="row">
                <div class="catagories-sec-inner">
                    @foreach ($categories as $catego)
                    <div class="i-box-s2" data-aos="fade-up">
                        <div class="thumb">
                            <img src="{{ asset('storage/files/' . ($catego->image ?? 'default.png')) }}" alt />
                        </div>
                        <div class="content">
                            <h3>{{$catego->name}}</h3>
                            <a href="{{ route('site.centers', ['category_id' => $catego->id]) }}" class="f-btn">
                                {{ __('site.view_all') }}<i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Clinics --}}
    <section class="product-gallery-s1 accent-lightBlue s-padding">
        <div class="container">
            <div class="s-title-wrap">
                <p class="s-sub-title">{{ __('site.clinics_subtitle') }}</p>
                <h2 class="s-title">{{ __('site.clinics_title') }}</h2>
            </div>
            <div class="row">
                @foreach ($centers as $center)
                <div class="col-xl-4 col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="pro-box-s1">
                        <div class="thumb">
                            <img src="{{ asset('storage/files/' . $center->center_logo ?? '') }}" alt />
                            <div class="purchas-preview-wrap">
                                <a href="{{route('site.center',$center->id)}}">{{ __('site.preview') }}</a>
                            </div>
                        </div>
                        <div class="content">
                            <p class="p-meta">
                                {{ __('site.by') }}<a class="author"> {{$center->user->name}}</a>
                                {{ __('site.in') }}
                                <a href="{{ route('site.centers', ['category_id' => $center->category->id]) }}" class="catagory">{{$center->category->name}}</a>
                            </p>
                            <h4 class="p-title"><a href="{{route('site.center',$center->id)}}"> {{$center->center_name}}</a></h4>
                            <div class="download-rating-wrap">
                                <div class="p-meta">
                                    <a class="author">{{$center->country->name}}</a> /
                                    <a href="{{ route('site.centers', ['city_id' => $center->city->id]) }}" class="catagory">{{$center->city->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="t-center view-all">
                    <a href="{{route('site.centers')}}" class="btn btn-s3">{{ __('site.view_all_clinics') }}</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="features-sec-s2 s-padding">
        <div class="container">
            <div class="s-title-wrap">
                <p class="s-sub-title">{{ __('site.features_subtitle') }}</p>
                <h2 class="s-title">{{ __('site.features_title') }}</h2>
            </div>
            <div class="row">
                <div class="feat-box-s1-wrap">
                    <div class="feat-box-s1" data-aos="fade-right">
                        <div class="thumb"><img src="{{ asset('assets/images/icons/feature1-icon1.svg')}}" alt /></div>
                        <div class="content">
                            <h4>{{ __('site.feature_1') }}</h4>
                        </div>
                    </div>
                    <div class="feat-box-s1" data-aos="fade-right" data-aos-delay="150">
                        <div class="thumb"><img src="{{ asset('assets/images/icons/feature1-icon2.svg')}}" alt /></div>
                        <div class="content">
                            <h4>{{ __('site.feature_2') }}</h4>
                        </div>
                    </div>
                    <div class="feat-box-s1" data-aos="fade-right" data-aos-delay="150">
                        <div class="thumb"><img src="{{ asset('assets/images/icons/feature1-icon3.svg')}}" alt /></div>
                        <div class="content">
                            <h4>{{ __('site.feature_3') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shapes">
            <img src="{{ asset('assets/images/shapes/features2-1.png')}}" alt class="shp-1" />
            <img src="{{ asset('assets/images/shapes/features2-2.png')}}" alt class="shp-2" />
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-s2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content">
                        <h2 class="s-title">
                            <span class="t-light">{{ __('site.cta_title') }}</span>{{ __('site.cta_subtitle') }}
                        </h2>
                        <button class="btn btn-s4">{{ __('site.cta_btn') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="Contact" class="contact-main s-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="contact-main__info">
                        <h2 class="title">{{ __('site.contact_title') }}</h2>
                        <p class="desc">{{ __('site.contact_desc') }}</p>
                        <div class="row">
                            <div class="contact-boxes-wrap">
                                <div class="c-box">
                                    <div class="icon"><img src="assets/images/icons/phone.svg" alt /></div>
                                    <div class="content">
                                        <h3>{{ __('site.contact_phone') }}</h3>
                                        <p>+(323) 9847 3847 383</p>
                                        <p>+(434) 5466 5467 443</p>
                                    </div>
                                </div>
                                <div class="c-box">
                                    <div class="icon"><img src="assets/images/icons/email.svg" alt /></div>
                                    <div class="content">
                                        <h3>{{ __('site.contact_email') }}</h3>
                                        <p>info@example.com</p>
                                        <p>support@example.com</p>
                                    </div>
                                </div>
                                <div class="c-box map">
                                    <div>
                                        <div class="box">
                                            <div class="icon"><img src="assets/images/icons/location.svg" alt /></div>
                                            <div class="content">
                                                <h3>{{ __('site.contact_address') }}</h3>
                                                <p>4517 Washington Ave. Manchester, Road</p>
                                                <p>2342, Kentucky 39495</p>
                                            </div>
                                        </div>
                                        <div class="map-wrap">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14600.380994918401!2d90.3665415!3d23.8152118!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1dea3ec2f7a32054!2sQuomodoSoft!5e0!3m2!1sen!2sbd!4v1664687133594!5m2!1sen!2sbd" allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="contact-main__form">
                        <form action="{{ route('contact.store') }}" method="POST" class="form">
                            @csrf
                            <h3 class="frm-header">{{ __('site.form_title') }}</h3>
                            <div class="inner-wrap">
                                <div class="s-input">
                                    <label>{{ __('site.contact_name') }}*</label>
                                    <input type="text" name="name" placeholder="{{ __('site.contact_name') }}" />
                                </div>
                                <div class="s-input">
                                    <label>{{ __('site.contact_email_lbl') }}*</label>
                                    <input type="text" name="email" placeholder="{{ __('site.contact_email_lbl') }}" />
                                </div>
                                <div class="s-input">
                                    <label>{{ __('site.contact_subject') }}*</label>
                                    <input type="text" name="subject" placeholder="{{ __('site.contact_subject') }}" />
                                </div>
                                <div class="s-input">
                                    <label>{{ __('site.contact_message') }}*</label>
                                    <textarea name="description" placeholder="{{ __('site.contact_message') }}"></textarea>
                                </div>
                                <div class="f-bottom">
                                    <button class="btn btn-s2 btn-lg" type="submit">{{ __('site.contact_send') }}</button>
                                </div>
                            </div>
                        </form>
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
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
                    <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></div>
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
                    <a href="#"><img src="{{ asset('assets/images/thumbs/p-gateway-img.png')}}" alt /></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/font-awesome.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/counterup.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/aos.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/gsap.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/scrollTrigger.min.js')}}"></script>
    <script src="{{ asset('assets/js/animations.js')}}"></script>
    <script src="{{ asset('assets/js/plugin.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script>
        // إغلاق قائمة المريض عند النقر خارجها
        document.addEventListener('click', function(e) {
            var dd = document.querySelector('.patient-dropdown');
            var menu = document.getElementById('patientMenu');
            if (dd && menu && !dd.contains(e.target)) {
                menu.classList.remove('show');
            }
        });

        function openModal() {
            document.getElementById('simpleModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('simpleModal').style.display = "none";
        }
        @if(session('success')) openModal();
        @endif
    </script>
</body>

</html>
