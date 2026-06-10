@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Countries') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Countries') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Countries') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="#" class="btn btn-primary create_country"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __(' SN') }}</th>
                                                <th>{{ __(' Name') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($countries as $index => $country)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $country->name }}</td>
                                                    <td>
                                                        @if ($country->status == 'active')
                                                            <a href="javascript:;"
                                                                onclick="changecountryStatus({{ $country->id }})">
                                                                <input id="status_toggle" type="checkbox" checked
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changecountryStatus({{ $country->id }})">
                                                                <input id="status_toggle" type="checkbox"
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="#" class="btn btn-primary btn-sm" id="country-edit" data-id="{{ $country->id }}"><i
                                                            class="fa fa-edit" aria-hidden="true" ></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $country->id }})"><i
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
        $('.create_country').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: "{{ route('admin.country.create') }}",
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

        //countryForm submit
        $(document).on('submit', '.countryForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.country.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                localStorage.setItem('notification', JSON.stringify(response.notification));
                window.location.href = response.redirect_url; // احصل على الرابط من الرد

                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                     toastr.error('تاكد من البيانات');

                        // عرض الأخطاء لكل حقل
                        if (errors.phone) {
                            $('.error-phone').text(errors.phone[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });

//جلب بيانات تعديل الcountry
        $(document).on('click', '#country-edit', function(e) {
            var countryId = $(this).data('id'); // Get ID

                $.ajax({
                    url: "{{ route('admin.country.edit', ':id') }}".replace(':id', countryId),
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


        //countryEditForm submit
        $(document).on('submit', '.countryEditForm', function(e) {
            e.preventDefault();
            var countryId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let form = this;
            let formData = new FormData(form);

            formData.append('_token', $('input[name="_token"]').val());
            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('admin.country.update', ':id') }}".replace(':id', countryId),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    localStorage.setItem('notification', JSON.stringify(response.notification));
                    window.location.href = response.redirect_url; // احصل على الرابط من الرد
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                     toastr.error('تاكد من البيانات');

                        // عرض الأخطاء لكل حقل
                        if (errors.phone) {
                            $('.error-phone').text(errors.phone[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });

        function deleteData(id){
        $("#deleteForm").attr("action","{{ route('admin.country.destroy', ':id') }}".replace(':id', id))
        }
///change country Status
        function changecountryStatus(id){
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{ route('admin.country.status', ':id') }}".replace(':id', id),
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endpush
