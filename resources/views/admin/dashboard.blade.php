@extends('layouts.dash_master')
@section('title')
<title>{{ __('Dashboard') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- ===== العيادات ===== --}}
                <div class="col-12">
                    <h4 class="dashboard_title">{{ app()->getLocale() == 'ar' ? 'العيادات' : 'Clinics' }}</h4>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-hospital"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'إجمالي العيادات' : 'Total Clinics' }}</h4></div>
                            <div class="card-body">{{ $stats['total_centers'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-check-circle"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'موثقة' : 'Approved' }}</h4></div>
                            <div class="card-body">{{ $stats['approved_centers'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-hourglass-half"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'قيد المراجعة' : 'Pending Review' }}</h4></div>
                            <div class="card-body">{{ $stats['pending_centers'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger"><i class="fas fa-times-circle"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'مرفوضة' : 'Rejected' }}</h4></div>
                            <div class="card-body">{{ $stats['rejected_centers'] }}</div>
                        </div>
                    </div>
                </div>

                {{-- ===== المستخدمون ===== --}}
                <div class="col-12 mt-4">
                    <h4 class="dashboard_title">{{ app()->getLocale() == 'ar' ? 'المستخدمون' : 'Users' }}</h4>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-users"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'إجمالي المستخدمين' : 'Total Users' }}</h4></div>
                            <div class="card-body">{{ $stats['total_users'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-user-injured"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'المرضى' : 'Patients' }}</h4></div>
                            <div class="card-body">{{ $stats['total_patients'] }}</div>
                        </div>
                    </div>
                </div>

                {{-- ===== المواعيد ===== --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-calendar-check"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'إجمالي المواعيد' : 'Total Appointments' }}</h4></div>
                            <div class="card-body">{{ $stats['total_appointments'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-clock"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'مواعيد قادمة' : 'Scheduled' }}</h4></div>
                            <div class="card-body">{{ $stats['pending_appointments'] }}</div>
                        </div>
                    </div>
                </div>

                {{-- ===== بيانات النظام ===== --}}
                <div class="col-12 mt-4">
                    <h4 class="dashboard_title">{{ app()->getLocale() == 'ar' ? 'بيانات النظام' : 'System Data' }}</h4>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary"><i class="fas fa-th-large"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'التخصصات' : 'Categories' }}</h4></div>
                            <div class="card-body">{{ $stats['total_categories'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary"><i class="fas fa-globe"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'الدول' : 'Countries' }}</h4></div>
                            <div class="card-body">{{ $stats['total_countries'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-secondary"><i class="fas fa-city"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'المدن' : 'Cities' }}</h4></div>
                            <div class="card-body">{{ $stats['total_cities'] }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
