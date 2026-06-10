<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('user.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>{{ __('admin.Dashboard') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('user.patient.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.patient.index') }}">
                    <i class="fas fa-users"></i>
                    <span>{{ __('admin.Patients') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('user.service.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.service.index') }}">
                    <i class="fas fa-file"></i>
                    <span>{{ __('admin.Services') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('user.appointment.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.appointment.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>{{ __('admin.Appointments') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('user.order.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.order.index') }}">
                    <i class="fas fa-file"></i>
                    <span>{{ __('admin.Orders') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('user.general-setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.general-setting') }}">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('admin. General Setting') }}</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
