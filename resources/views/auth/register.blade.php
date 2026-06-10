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
    <title>{{ __('site.register') }}</title>
    @if(app()->getLocale() == 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
    @endif
    <style>
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
                        <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="frm-header">{{ __('site.register') }}</h3>
                            <div class="inner-wrap">

                                {{-- Name + Email --}}
                                <div class="input-grp">
                                    <div class="s-input">
                                        <label for="name">{{ app()->getLocale() == 'ar' ? 'الاسم' : 'Name' }}*</label>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                            placeholder="{{ app()->getLocale() == 'ar' ? 'اسمك الكامل' : 'Full Name' }}" />
                                        @error('name')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input">
                                        <label for="email">{{ __('site.contact_email_lbl') }}*</label>
                                        <input id="email" type="text" name="email" value="{{ old('email') }}" required
                                            placeholder="{{ __('site.contact_email_lbl') }}" />
                                        @error('email')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- Password + Confirm --}}
                                <div class="input-grp">
                                    <div class="s-input">
                                        <label for="password">{{ app()->getLocale() == 'ar' ? 'كلمة المرور' : 'Password' }}*</label>
                                        <input id="password" type="password" name="password" required
                                            autocomplete="new-password" placeholder="********" />
                                        @include('components.password-strength', ['inputId' => 'password'])
                                        @error('password')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input">
                                        <label for="password_confirmation">{{ app()->getLocale() == 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}*</label>
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            required placeholder="********" />
                                        @error('password_confirmation')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- Clinic Name --}}
                                <div class="s-input">
                                    <label for="clinic_name">{{ app()->getLocale() == 'ar' ? 'اسم العيادة' : 'Clinic Name' }}*</label>
                                    <input id="clinic_name" type="text" name="clinic_name" value="{{ old('clinic_name') }}" required
                                        placeholder="{{ app()->getLocale() == 'ar' ? 'اسم العيادة' : 'Clinic Name' }}" />
                                    @error('clinic_name')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                </div>

                                {{-- Category + Country + City --}}
                                <div class="input-grp row">
                                    <div class="s-input col-4">
                                        @php $categories = App\Models\Category::active()->get(); @endphp
                                        <label>{{ app()->getLocale() == 'ar' ? 'التخصص' : 'Category' }}*</label>
                                        <select id="category" name="category_id" required>
                                            <option value="" disabled selected>{{ app()->getLocale() == 'ar' ? 'اختر التخصص' : 'Select Category' }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input col-4">
                                        @php $countries = App\Models\Country::active()->get(); @endphp
                                        <label>{{ app()->getLocale() == 'ar' ? 'الدولة' : 'Country' }}*</label>
                                        <select id="country" name="country_id" required>
                                            <option value="" disabled selected>{{ app()->getLocale() == 'ar' ? 'اختر الدولة' : 'Select Country' }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input col-4">
                                        <label>{{ app()->getLocale() == 'ar' ? 'المدينة' : 'City' }}*</label>
                                        <div id="city"></div>
                                        @error('city_id')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- Address + Phone --}}
                                <div class="input-grp">
                                    <div class="s-input">
                                        <label for="address">{{ app()->getLocale() == 'ar' ? 'العنوان' : 'Address' }}*</label>
                                        <input id="address" type="text" name="address" value="{{ old('address') }}" required
                                            placeholder="{{ app()->getLocale() == 'ar' ? 'عنوان العيادة' : 'Clinic Address' }}" />
                                        @error('address')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input">
                                        <label for="phone">{{ __('site.patient_phone') }}*</label>
                                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                                            placeholder="{{ app()->getLocale() == 'ar' ? 'هاتف العيادة' : 'Clinic Phone' }}" />
                                        @error('phone')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- License Number + License File --}}
                                <div class="input-grp">
                                    <div class="s-input">
                                        <label for="license_number">
                                            {{ app()->getLocale() == 'ar' ? 'رقم الترخيص الحكومي' : 'Government License Number' }}*
                                        </label>
                                        <input id="license_number" type="text" name="license_number"
                                            value="{{ old('license_number') }}" required
                                            placeholder="{{ app()->getLocale() == 'ar' ? 'رقم الترخيص الرسمي' : 'Official license number' }}" />
                                        @error('license_number')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="s-input">
                                        <label for="license_file">
                                            {{ app()->getLocale() == 'ar' ? 'ملف الترخيص (PDF أو صورة)' : 'License File (PDF or Image)' }}*
                                        </label>
                                        <input id="license_file" type="file" name="license_file"
                                            accept=".pdf,.jpg,.jpeg,.png" required style="padding:8px;" />
                                        @error('license_file')<span style="color:red;font-size:12px;">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                {{-- Remember Me --}}
                                <div class="input-grp">
                                    <div class="s-input">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            {{ app()->getLocale() == 'ar' ? 'تذكرني' : 'Remember Me' }}
                                        </label>
                                    </div>
                                </div>

                                <div class="f-bottom">
                                    <button class="btn btn-s2 btn-lg" type="submit">{{ __('site.register') }}</button>
                                    <p>
                                        {{ app()->getLocale() == 'ar' ? 'لديك حساب بالفعل؟' : 'Already have an Account?' }}
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
    <script>
    document.getElementById('country').onchange = function() {
        var countryId = this.value;
        if (countryId) {
            fetch(`/get-cities/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    var cityDiv = document.getElementById('city');
                    cityDiv.innerHTML = '';
                    if (data.cities && data.cities.length > 0) {
                        var citySelect = document.createElement('select');
                        citySelect.name = 'city_id';
                        citySelect.required = true;
                        var defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        defaultOption.textContent = '{{ app()->getLocale() == "ar" ? "اختر المدينة" : "Select City" }}';
                        citySelect.appendChild(defaultOption);
                        data.cities.forEach(function(city) {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.appendChild(option);
                        });
                        cityDiv.appendChild(citySelect);
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('city').innerHTML = '';
        }
    };
    </script>
</body>
</html>
