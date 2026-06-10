@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Appointments') }}</title>
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
            <div class="section-body">
                <a href="#" class="btn btn-primary create_appointment"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Duration') }}</th>
                                                <th>{{ __('Patient') }}</th>
                                                <th>{{ __('Service') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $index => $appointment)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $appointment->appointment_date }}</td>
                                                    @php
                                                        // تحويل وقت الموعد إلى كائن Carbon
                                                        $appointmentTime = Carbon\Carbon::createFromFormat('H:i:s', $appointment->appointment_time);
                                                    @endphp
                                                    <td>{{ $appointmentTime->format('H:i') }} - {{ $appointmentTime->addMinutes($appointment->service->duration)->format('H:i') }}</td>
                                                    <td>{{ $appointment->patient->name }}</td>
                                                    <td>{{ $appointment->service->name }}</td>
                                                    <td>{{ $appointment->status }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" id="appointment-edit" data-id="{{ $appointment->id }}"><i
                                                                class="fa fa-edit" aria-hidden="true" ></i></a>

                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $appointment->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ceratModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- سيتم تحميل المحتوى هنا -->
            </div>
        </div>
    </div>

@endsection
@push('js')

<script>
    $(document).ready(function() {
        $('.create_appointment').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: 'appointment/create',
                method: 'GET',
                success: function(response) {
                    // تعيين المحتوى إلى المودال
                    $('#ceratModal .modal-content').html(response.modalContent);
                    $('#ceratModal').modal('show');
                },
                error: function() {
                    alert('حدث خطأ أثناء جلب بيانات الطلب.');
                }
            });
        });
    });

</script>
<script>

        //appointmentForm submit
        $(document).on('submit', '.appointmentForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/appointment',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    localStorage.setItem('notification', JSON.stringify(response.notification));
                    window.location.href = response.redirect_url; // احصل على الرابط من الرد
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                     toastr.error('تاكد من البيانات');
                        // عرض الأخطاء لكل حقل
                        if (errors.patient_id) {
                            $('.error-patient_id').text(errors.patient_id[0]);
                        }
                        if (errors.service_id) {
                            $('.error-service_id').text(errors.service_id[0]);
                        }
                        if (errors.appointment_date) {
                            $('.error-appointment_date').text(errors.appointment_date[0]);
                        }
                        if (errors.appointment_time) {
                            $('.error-appointment_time').text(errors.appointment_time[0]);
                        }
                        if (errors.notes) {
                            $('.error-notes').text(errors.notes[0]);
                        }
                    }
                }
            });
        });

//جلب بيانات تعديل الappointment
        $(document).on('click', '#appointment-edit', function(e) {
            var appointmentId = $(this).data('id'); // Get ID

                $.ajax({
                    url: '/appointment/'+ appointmentId + '/edit' ,
                    method: 'GET',
                    success: function(response) {
                        // تعيين المحتوى إلى المودال
                        $('#ceratModal .modal-content').html(response.modalContent);
                        $('#ceratModal').modal('show');
                    },
                    error: function() {
                       toastr.warning('حدث خطأ أثناء جلب بيانات الطلب.');
                    }
                    });
        });


        //appointmentEditForm submit
        $(document).on('submit', '.appointmentEditForm', function(e) {
            e.preventDefault();
            var appointmentId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/appointment/'+ appointmentId,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    localStorage.setItem('notification', JSON.stringify(response.notification));
                    window.location.href = response.redirect_url; // احصل على الرابط من الرد
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                     toastr.error('تاكد من البيانات');

                        // عرض الأخطاء لكل حقل
                        if (errors.patient_id) {
                            $('.error-patient_id').text(errors.patient_id[0]);
                        }
                        if (errors.service_id) {
                            $('.error-service_id').text(errors.service_id[0]);
                        }
                        if (errors.appointment_date) {
                            $('.error-appointment_date').text(errors.appointment_date[0]);
                        }
                        if (errors.appointment_time) {
                            $('.error-appointment_time').text(errors.appointment_time[0]);
                        }
                        if (errors.notes) {
                            $('.error-notes').text(errors.notes[0]);
                        }
                        if (errors.status) {
                            $('.error-status').text(errors.status[0]);
                        }
                    }
                }
            });
        });
</script>


@endpush
