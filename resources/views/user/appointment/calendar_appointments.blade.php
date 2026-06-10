@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Appointments') }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-3w-FGL6c.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-D6xHkvPb.css') }}"> --}}

@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Appointments') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('Aashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Appointments') }}</div>
                </div>
            </div>

            <div class="card p-5">
                <div id="calendar"></div>
            </div>
        </section>
    </div>

    {{-- eventModal --}}
    <div id="eventModal"
        style="display: none; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -20%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
        <div id="modalContent"></div>
        <button onclick="document.getElementById('eventModal').style.display='none'">إغلاق</button>
    </div>
@endsection

@push('js')
<script>
  const calendarEvents = [
    @foreach ($appointments as $appointment)
    { id :{{$appointment->id}},title:'{{$appointment->patient->name . ' - ' . $appointment->service->name}}', start:'{{$appointment->appointment_date . ' ' . \Carbon\Carbon::createFromFormat('H:i:s',$appointment->appointment_time)->format('h:i')}}',end:'{{$appointment->appointment_date . ' ' . \Carbon\Carbon::createFromFormat('H:i:s',$appointment->appointment_time)->addMinutes($appointment->service->duration)->format('h:i')}}'},
    @endforeach
    ];
</script>
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- <script src="{{ asset('build/assets/app-BBPY8xHc.js') }}"></script> --}}

@endpush
