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
    <title>{{ __('site.clinics') }}</title>

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

        .nice-select .list {
            z-index: 9999 !important;
        }

        .p-search-cat {
            position: relative;
            z-index: 1000;
        }

        #map {
            z-index: 1 !important;
            position: relative;
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
                                <li><a href="/">{{ __('site.blog') }}</a></li>
                                <li><a href="#Contact">{{ __('site.contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>

                    {{-- ✅ p-right: الأزرار + اللغة + زر الموبايل --}}
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

    <section class="page-banner-s1">
        <div class="container">
            <div class="row">
                <div class="p-banner-inner">
                    <h1 class="s-title">{{ __('site.clinics') }}</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('site.show') }}">{{ __('site.home') }}</a></li>
                        <li><a href="#">{{ __('site.clinics_page') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shapes">
            <ul class="animated-boxes-l animated-boxes">
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
            </ul>
        </div>
    </section>

    <section class="p-archive-main">
        <div class="container">
            <form action="{{ route('site.centers') }}" method="GET" id="filter-form">
                <div class="row p-search-cat" style="gap:10px 0;">
                    <div class="col-12 col-md-3 d-flex justify-end" style="margin-bottom:10px;">
                        <select name="city_id" id="city_id"
                            style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;"
                            onchange="document.getElementById('filter-form').submit()">
                            <option value="">{{ __('site.all_cities') }}</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-3 d-flex justify-end" style="margin-bottom:10px;">
                        <select name="category_id" id="category_id"
                            style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;"
                            onchange="document.getElementById('filter-form').submit()">
                            <option value="">{{ __('site.all_categories') }}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="s-bar-s2">
                            <div class="s-bar-inner">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('site.search_placeholder') }}" />
                                <button type="submit" class="btn btn-frm">
                                    <i class="fa-solid fa-magnifying-glass"></i>{{ __('site.search_btn') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div id="map" style="height:400px; margin:20px 0; border-radius:10px;"></div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="p-archive-listing">
                        @forelse ($centers as $center)
                        <div class="col-xl-4 col-lg-4 col-md-4" data-aos="fade-up">
                            <div class="pro-box-s1">
                                <div class="thumb">
                                    <img src="{{ asset('storage/files/' . ($center->center_logo ?? '')) }}" alt />
                                    <div class="purchas-preview-wrap">
                                        <a href="{{ route('site.center', $center->id) }}">{{ __('site.preview') }}</a>
                                    </div>
                                </div>
                                <div class="content">
                                    <p class="p-meta">
                                        {{ __('site.by') }}<a class="author"> {{ $center->user->name }}</a>
                                        {{ __('site.in') }}
                                        <a href="{{ route('site.centers', ['category_id' => $center->category->id]) }}" class="catagory">{{ $center->category->name }}</a>
                                    </p>
                                    <h4 class="p-title">
                                        <a href="{{ route('site.center', $center->id) }}">{{ $center->center_name }}</a>
                                    </h4>
                                    <div class="download-rating-wrap">
                                        <div class="p-meta">
                                            <a class="author">{{ $center->country->name }}</a> /
                                            <a href="{{ route('site.centers', ['city_id' => $center->city->id]) }}" class="catagory">{{ $center->city->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12" style="text-align:center; padding:40px; color:#999;">
                            {{ __('site.no_results') }}
                        </div>
                        @endforelse
                    </div>
                    <div class="pagination">
                        <button class="prev-page">
                            <span class="text">{{ __('site.prev_page') }}</span>
                            <span class="icon"><i class="fa-solid fa-angle-left"></i></span>
                        </button>
                        <ul class="page-items">
                            <li><a class="current" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                        <button class="next-page">
                            <span class="text">{{ __('site.next_page') }}</span>
                            <span class="icon"><i class="fa-solid fa-angle-right"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <p style="color:rgb(8,187,32)">{{ session('success') }}</p>
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
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([31.5, 34.5], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        var centers = @json($centers);
        centers.forEach(function(center) {
            if (center.latitude && center.longitude) {
                var marker = L.marker([center.latitude, center.longitude]).addTo(map);
                marker.bindPopup('<b>' + center.center_name + '</b><br><a href="/center/' + center.id + '">{{ __("site.preview") }}</a>');
            }
        });
    </script>
</body>

</html>
