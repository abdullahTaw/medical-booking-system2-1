@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Patients') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Patients') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Patients') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="#" class="btn btn-primary create_patient"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('City') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patients as $index => $patient)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $patient->phone }}</td>
                                                    <td>{{ $patient->city }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" id="patient-edit" data-id="{{ $patient->id }}"><i
                                                                class="fa fa-edit" aria-hidden="true" ></i></a>

                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $patient->id }})"><i
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
        $('.create_patient').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: 'patient/create',
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
        $(document).on('change', '#country', function(e) {
            var countryId = $(this).val(); // Get selected country ID
            var $citySelect = $('#city'); // Reference to the city select element
            // Clear previous options
            $citySelect.html('<option value="">اختر مدينة</option>');

            // If a country is selected, fetch its cities
            if (countryId) {
                $.ajax({
                    url: '/get-cities',
                    type: 'GET',
                    data: { country_id: countryId },
                    success: function (cities) {
                        // Populate the city dropdown with the returned data
                        $.each(cities, function (index, city) {
                            $citySelect.append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('حدث خطأ أثناء جلب المدن. يرجى المحاولة مرة أخرى.');
                    }
                });
            }
        });

        //patientForm submit
        $(document).on('submit', '.patientForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/patient',
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
                        if (errors.address) {
                            $('.error-address').text(errors.address[0]);
                        }
                        if (errors.date_of_birth) {
                            $('.error-date_of_birth').text(errors.date_of_birth[0]);
                        }
                        if (errors.gender) {
                            $('.error-gender').text(errors.gender[0]);
                        }
                        if (errors.phone) {
                            $('.error-phone').text(errors.phone[0]);
                        }
                        if (errors.email) {
                            $('.error-email').text(errors.email[0]);
                        }
                        if (errors.blood_type) {
                            $('.error-blood_type').text(errors.blood_type[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });

//جلب بيانات تعديل الpatient
        $(document).on('click', '#patient-edit', function(e) {
            var patientId = $(this).data('id'); // Get ID

                $.ajax({
                    url: '/patient/'+ patientId + '/edit' ,
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


        //patientEditForm submit
        $(document).on('submit', '.patientEditForm', function(e) {
            e.preventDefault();
            var patientId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/patient/'+ patientId,
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
                        if (errors.address) {
                            $('.error-address').text(errors.address[0]);
                        }
                        if (errors.date_of_birth) {
                            $('.error-date_of_birth').text(errors.date_of_birth[0]);
                        }
                        if (errors.gender) {
                            $('.error-gender').text(errors.gender[0]);
                        }
                        if (errors.phone) {
                            $('.error-phone').text(errors.phone[0]);
                        }
                        if (errors.email) {
                            $('.error-email').text(errors.email[0]);
                        }
                        if (errors.blood_type) {
                            $('.error-blood_type').text(errors.blood_type[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });
</script>
@endpush
