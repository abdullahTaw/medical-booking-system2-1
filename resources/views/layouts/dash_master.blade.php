@include('layouts.dash_header')
<body>

@if(app()->getLocale() == 'ar')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Cairo', sans-serif !important; }
</style>
@endif

  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">

          {{-- زر تبديل اللغة --}}
          <li class="nav-item" style="display:flex;align-items:center;padding:0 10px;">
            <form action="{{ route('locale.switch') }}" method="POST" style="margin:0;">
                @csrf
                <input type="hidden" name="locale" value="{{ app()->getLocale() == 'en' ? 'ar' : 'en' }}">
                <button type="submit" style="background:transparent;border:1.5px solid #fff;color:#fff;border-radius:6px;padding:4px 12px;font-size:13px;cursor:pointer;font-weight:500;">
                    {{ app()->getLocale() == 'en' ? 'العربية' : 'English' }}
                </button>
            </form>
          </li>

          <li class="dropdown dropdown-list-toggle">
            <a target="_blank" href="/" class="nav-link nav-link-lg">
                <i class="fas fa-home"></i> {{ __('admin.Visit Website') }}
            </a>
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('dashboard.profile') }}" class="dropdown-item has-icon">
    <i class="far fa-user"></i> {{ __('admin.Profile') }}
</a>
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('admin.Logout') }}
              </a>
              <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>

        </ul>
      </nav>

      @yield('dash-content')

      <footer class="main-footer">
        <div class="footer-left"></div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>

  @include('layouts.dash_footer')
