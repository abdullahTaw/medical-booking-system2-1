@extends('layouts.dash_master')
@section('title')
<title>{{ __('Dashboard') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- ===== حالة العيادة ===== --}}
                <div class="col-12 mb-3">
                    @if($stats['license_status'] == 'approved')
                        <div class="alert" style="background:#d4edda; color:#155724; border-radius:8px; padding:12px 16px; font-size:13px;">
                            <i class="fa-solid fa-shield-halved"></i>
                            {{ app()->getLocale() == 'ar' ? 'عيادتك موثقة وفعّالة' : 'Your clinic is approved and active' }}
                        </div>
                    @elseif($stats['license_status'] == 'pending')
                        <div class="alert" style="background:#fff3cd; color:#856404; border-radius:8px; padding:12px 16px; font-size:13px;">
                            <i class="fa-solid fa-hourglass-half"></i>
                            {{ app()->getLocale() == 'ar' ? 'عيادتك قيد المراجعة من قبل الإدارة' : 'Your clinic is under review' }}
                        </div>
                    @else
                        <div class="alert" style="background:#f8d7da; color:#721c24; border-radius:8px; padding:12px 16px; font-size:13px;">
                            <i class="fa-solid fa-circle-xmark"></i>
                            {{ app()->getLocale() == 'ar' ? 'تم رفض ترخيص عيادتك' : 'Your clinic license was rejected' }}
                        </div>
                    @endif
                </div>

                {{-- ===== نظرة عامة ===== --}}
                <div class="col-12">
                    <h4 class="dashboard_title">{{ app()->getLocale() == 'ar' ? 'نظرة عامة' : 'Overview' }}</h4>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-box"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'الخدمات' : 'Services' }}</h4></div>
                            <div class="card-body">{{ $stats['total_services'] }}</div>
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

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-star"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'متوسط التقييم' : 'Avg Rating' }}</h4></div>
                            <div class="card-body">
                                {{ $stats['avg_rating'] > 0 ? $stats['avg_rating'] : '—' }}
                                <small style="font-size:12px; color:#999;">
                                    ({{ $stats['ratings_count'] }} {{ app()->getLocale() == 'ar' ? 'تقييم' : 'ratings' }})
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== المواعيد ===== --}}
                <div class="col-12 mt-4">
                    <h4 class="dashboard_title">{{ app()->getLocale() == 'ar' ? 'المواعيد' : 'Appointments' }}</h4>
                </div>

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
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'القادمة' : 'Scheduled' }}</h4></div>
                            <div class="card-body">{{ $stats['pending_appointments'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-circle-check"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>{{ app()->getLocale() == 'ar' ? 'مكتملة' : 'Completed' }}</h4></div>
                            <div class="card-body">{{ $stats['completed_appointments'] }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
