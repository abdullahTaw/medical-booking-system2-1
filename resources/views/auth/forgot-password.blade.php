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
    <title>{{ app()->getLocale() == 'ar' ? 'نسيت كلمة المرور' : 'Forgot Password' }}</title>
    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif
    <style>
        .lang-btn { background:transparent; border:1.5px solid #3498db; color:#3498db; border-radius:6px; padding:4px 12px; font-size:13px; cursor:pointer; font-weight:500; }
        .lang-btn:hover { background:#3498db; color:#fff; }
        .alert-status { background:#d4edda; color:#155724; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13px; }
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
                    <div class="p-right" style="display:flex; align-items:center; gap:8px;">
                        <a href="{{ route('login') }}" style="font-size:13px; font-weight:600; color:#333; padding:6px 14px; border:1px solid #ddd; border-radius:6px; white-space:nowrap; text-decoration:none;">
                            {{ __('site.login') }}
                        </a>
                        <form action="{{ route('locale.switch') }}" method="POST" style="display:inline">
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
        </div>
    </aside>

    <section class="signup-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login-main__form">
                        <form method="POST" action="{{ route('password.email') }}" class="form">
                            @csrf
                            <h3 class="frm-header">
                                {{ app()->getLocale() == 'ar' ? 'نسيت كلمة المرور؟' : 'Forgot Password?' }}
                            </h3>
                            <p style="text-align:center; font-size:13px; color:#7f8c8d; margin-bottom:16px;">
                                {{ app()->getLocale() == 'ar'
                                    ? 'أدخل بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور.'
                                    : 'Enter your email and we will send you a password reset link.' }}
                            </p>

                            <div class="inner-wrap">

                                @session('status')
                                    <div class="alert-status">{{ $value }}</div>
                                @endsession

                                <div class="s-input">
                                    <label for="email">{{ __('site.contact_email_lbl') }}*</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="{{ __('site.contact_email_lbl') }}" />
                                    @error('email')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                </div>

                                <div class="f-bottom">
                                    <button class="btn btn-s2 btn-lg" type="submit">
                                        {{ app()->getLocale() == 'ar' ? 'إرسال رابط إعادة التعيين' : 'Email Password Reset Link' }}
                                    </button>
                                    <p>
                                        {{ app()->getLocale() == 'ar' ? 'تذكرت كلمة المرور؟' : 'Remembered your password?' }}
                                        <a href="{{ route('login') }}">{{ __('site.login') }}</a>
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
        <div class="container-stretch">
            <div class="f-copy-right">
                <div class="p-left">
                    <p class="cr-text">©{{ date('Y') }} {{ __('site.footer_rights') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/font-awesome.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
