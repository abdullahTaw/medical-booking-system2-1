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
    <title>{{ __('site.login') }}</title>
    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif
    <style>
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }
        .license-alert {
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .license-alert.rejected {
            background: #fff0f0;
            border-color: #e74c3c;
            color: #c0392b;
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
        <div class="h-top-container bg-gray">
            <div class="container-stretch">
                <div class="h-top-inner">
                    <div class="p-left">
                        <ul class="t-bar-menu">
                            @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end" style="align-items:center;gap:8px;">
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
                        <div class="logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a></div>
                        <div class="m-logo"><a href="/"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></a></div>
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
            <div class="logo"><img src="{{ asset('assets/images/logos/a1.PNG')}}" alt /></div>
            <ul class="main-nav">
                <li><a href="/">{{ __('site.home') }}</a></li>
                <li><a href="{{ route('site.centers') }}">{{ __('site.clinics') }}</a></li>
                <li><a href="/">{{ __('site.blog') }}</a></li>
                <li><a href="#Contact">{{ __('site.contact') }}</a></li>
            </ul>
        </div>
    </aside>

    <section class="signup-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login-main__form">
                        <form method="POST" action="{{ route('login') }}" class="form">
                            @csrf
                            <h3 class="frm-header">{{ __('site.login') }}</h3>
                            <div class="inner-wrap">

                                {{-- ✅ رسالة حالة الترخيص --}}
                                @if(session('license_error'))
                                    <div class="license-alert {{ str_contains(session('license_error'), 'رفض') || str_contains(session('license_error'), 'rejected') ? 'rejected' : '' }}">
                                        <span style="font-size:18px;">
                                            {{ str_contains(session('license_error'), 'رفض') || str_contains(session('license_error'), 'rejected') ? '🚫' : '⏳' }}
                                        </span>
                                        {{ session('license_error') }}
                                    </div>
                                @endif

                                <div class="s-input">
                                    <x-input-label for="email" :value="__('site.contact_email_lbl')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username"
                                        placeholder="{{ __('site.contact_email_lbl') }}" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="s-input">
                                    <x-input-label for="password" :value="__('admin.Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="current-password" placeholder="********" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="input-grp">
                                    <div class="s-input">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            {{ app()->getLocale() == 'ar' ? 'تذكرني' : 'Remember Me' }}
                                        </label>
                                    </div>
                                    <div class="s-input t-right">
                                        <a class="forgot-pass-btn" href="{{ route('password.request') }}">
                                            {{ app()->getLocale() == 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot Password?' }}
                                        </a>
                                    </div>
                                </div>

                                <div class="f-bottom">
                                    <x-primary-button class="btn btn-s2 btn-lg fade">
                                        {{ __('site.login') }}
                                    </x-primary-button>
                                    <p>
                                        {{ app()->getLocale() == 'ar' ? 'ليس لديك حساب؟' : "Don't have an account?" }}
                                        <a href="{{ route('register') }}">{{ __('site.register') }}</a>
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
                    <h3 class="s-title" data-aos="fade-up">{{ __('site.subscribe_title') }}</h3>
                    <p data-aos="fade-up" data-aos-delay="50">{{ __('site.subscribe_desc') }}</p>
                    <div class="subs-form-s1" data-aos="fade-up" data-aos-delay="50">
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
                    <p class="cr-text">©2024 {{ __('site.footer_rights') }}</p>
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
</body>
</html>
