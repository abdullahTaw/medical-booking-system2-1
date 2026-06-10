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
                <h1>{{ __('cities') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('cities') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="#" class="btn btn-primary create_city"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __(' SN') }}</th>
                                                <th>{{ __('City') }}</th>
                                                <th>{{ __('Country') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cities as $index => $city)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $city->name }}</td>
                                                    <td>{{ $city->country->name }}</td>
                                                    <td>
                                                        @if ($city->status == 'active')
                                                            <a href="javascript:;"
                                                                onclick="changecityStatus({{ $city->id }})">
                                                                <input id="status_toggle" type="checkbox" checked
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changecityStatus({{ $city->id }})">
                                                                <input id="status_toggle" type="checkbox"
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="#" class="btn btn-primary btn-sm" id="city-edit" data-id="{{ $city->id }}"><i
                                                            class="fa fa-edit" aria-hidden="true" ></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $city->id }})"><i
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
        $('.create_city').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: "{{ route('admin.city.create') }}",
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

        //cityForm submit
        $(document).on('submit', '.cityForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.city.store') }}",
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

//جلب بيانات تعديل الcity
        $(document).on('click', '#city-edit', function(e) {
            var cityId = $(this).data('id'); // Get ID

                $.ajax({
                    url: "{{ route('admin.city.edit', ':id') }}".replace(':id', cityId),
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


        //cityEditForm submit
        $(document).on('submit', '.cityEditForm', function(e) {
            e.preventDefault();
            var cityId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let form = this;
            let formData = new FormData(form);

            formData.append('_token', $('input[name="_token"]').val());
            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('admin.city.update', ':id') }}".replace(':id', cityId),
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
        $("#deleteForm").attr("action","{{ route('admin.city.destroy', ':id') }}".replace(':id', id))
        }
///change city Status
        function changecityStatus(id){
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{ route('admin.city.status', ':id') }}".replace(':id', id),
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endpush
