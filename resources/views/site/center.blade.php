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
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif

    <style>
        .modal { display:none; position:fixed; z-index:999; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4); padding-top:60px; }
        .modal-content { background-color:#fff; margin:5% auto; padding:20px; border:1px solid #888; width:80%; max-width:500px; }
        .close-btn { color:#aaa; font-size:28px; font-weight:bold; float:right; cursor:pointer; }
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }
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
        <div class="h-top-container bg-gray">
            <div class="container-stretch">
                <div class="h-top-inner">
                    <div class="p-left">
                        <ul class="t-bar-menu">
                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end" style="align-items:center; gap:8px;">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black">{{ __('site.dashboard') }}</a>
                                    @else
                                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black">{{ __('site.login') }}</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black">{{ __('site.register') }}</a>
                                        @endif
                                    @endauth
                                    <form action="{{ route('locale.switch') }}" method="POST" style="display:inline">
                                        @csrf
                                        <input type="hidden" name="locale" value="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">
                                        <button type="submit" class="lang-btn">{{ __('site.language') }}</button>
                                    </form>
                                </nav>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
                    <div class="p-right">
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
                            <ul class="catagories"><p>{{ $center->center_address ?? '' }}</p></ul>
                            <div class="rating">
                                <div class="rating-text"><p>{{ $center->phone ?? '' }}</p></div>
                            </div>
                        </div>
                        <div class="shapes">
                            <ul class="animated-boxes-l animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
                            <ul class="animated-boxes-r animated-boxes"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
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
                        <div class="tab-links" data-links-for="profile-tabs" style="max-width: 600px;">
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
                                            <form method="POST" action="{{ route('site.order') }}" class="form">
                                                @csrf
                                                <input type="hidden" name="center_id" value="{{ $center->id }}" />

                                                <div class="s-input">
                                                    <label for="name">{{ __('site.patient_name') }}*</label>
                                                    <input id="name" class="block mt-1 w-full" type="text" name="name"
                                                        value="{{ old('name') }}" required
                                                        placeholder="{{ __('site.patient_name') }}" />
                                                    @error('name')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="s-input">
                                                    <label for="email">{{ __('site.patient_email') }}</label>
                                                    <input id="email" class="block mt-1 w-full" type="email" name="email"
                                                        value="{{ old('email') }}" placeholder="{{ __('site.patient_email') }}" />
                                                    @error('email')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="s-input">
                                                    <label for="phone">{{ __('site.patient_phone') }}*</label>
                                                    <input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                                        value="{{ old('phone') }}" required
                                                        placeholder="{{ __('site.patient_phone') }}" />
                                                    @error('phone')<span class="text-red-500 mt-2">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="input-grp row">
                                                    <div class="s-input col-3">
                                                        <label for="service_id">{{ __('site.service_lbl') }}</label>
                                                        <select id="service_id" class="block mt-1 w-full" name="service_id">
                                                            <option value="" disabled selected>{{ __('site.select_service') }}</option>
                                                            @foreach ($center->services as $servic)
                                                                <option value="{{ $servic->id }}" {{ old('service_id') == $servic->id ? 'selected' : '' }}>
                                                                    {{ $servic->name }}
                                                                </option>
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
                                                    <input id="appointment_date" class="block mt-1 w-full" type="date" name="appointment_date"
                                                        value="{{ old('appointment_date') }}" />
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
                                        </div>
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
                    <p class="cr-text">©2024 {{ __('site.footer_rights') }}</p>
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
        function openModal() { document.getElementById('simpleModal').style.display = "block"; }
        function closeModal() { document.getElementById('simpleModal').style.display = "none"; }
        @if (session('success')) openModal(); @endif
    </script>
</body>
</html>
