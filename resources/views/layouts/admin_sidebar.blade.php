<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>{{ __('admin.Dashboard') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.center.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.center.index') }}">
                    <i class="fas fa-hospital"></i>
                    <span>{{ __('admin.Centers') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span>{{ __('admin.Categories') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.country.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.country.index') }}">
                    <i class="fas fa-globe"></i>
                    <span>{{ __('admin.Countries') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.city.index') }}">
                    <i class="fas fa-city"></i>
                    <span>{{ __('admin.Cities') }}</span>
                </a>
            </li>
            <li class="{{ Route::is('admin.message.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.message.index') }}">
                    <i class="fas fa-envelope"></i>
                    <span>{{ __('admin.Messages') }}</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
