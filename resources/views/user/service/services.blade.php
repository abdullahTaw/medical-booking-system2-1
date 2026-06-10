@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Services') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Services') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Services') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="#" class="btn btn-primary create_service"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
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
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Duration') }}</th>
                                                <th>{{ __('Is Active') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $index => $service)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $service->name }}</td>
                                                    <td>{{ $service->price }}</td>
                                                    <td>{{ $service->duration }}</td>
                                                    <td>
                                                        @if($service->is_active == 1)
                                                        <a href="javascript:;" onclick="changeServiceStatus({{ $service->id }})">
                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('Active')}}" data-off="{{__('Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                                        </a>

                                                        @else
                                                        <a href="javascript:;" onclick="changeServiceStatus({{ $service->id }})">
                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('Active')}}" data-off="{{__('Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                                        </a>

                                                        @endif
                                                    </td>                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" id="service-edit" data-id="{{ $service->id }}"><i
                                                                class="fa fa-edit" aria-hidden="true" ></i></a>

                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $service->id }})"><i
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
        $('.create_service').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: 'service/create',
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

        //serviceForm submit
        $(document).on('submit', '.serviceForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/service',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    localStorage.setItem('notification', JSON.stringify(response.notification));
                    window.location.href = response.redirect_url;
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                     toastr.error('تاكد من البيانات');

                        // عرض الأخطاء لكل حقل
                        if (errors.description) {
                            $('.error-description').text(errors.description[0]);
                        }
                        if (errors.price) {
                            $('.error-price').text(errors.price[0]);
                        }
                        if (errors.duration) {
                            $('.error-duration').text(errors.duration[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });

//جلب بيانات تعديل الservice
        $(document).on('click', '#service-edit', function(e) {
            var serviceId = $(this).data('id'); // Get ID

                $.ajax({
                    url: '/service/'+ serviceId + '/edit' ,
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


        //serviceEditForm submit
        $(document).on('submit', '.serviceEditForm', function(e) {
            e.preventDefault();
            var serviceId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/service/'+ serviceId,
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
                        if (errors.description) {
                            $('.error-description').text(errors.description[0]);
                        }
                        if (errors.price) {
                            $('.error-price').text(errors.price[0]);
                        }
                        if (errors.duration) {
                            $('.error-duration').text(errors.duration[0]);
                        }
                        if (errors.name) {
                            $('.error-name').text(errors.name[0]);
                        }
                    }
                }
            });
        });

///change Service Status
        function changeServiceStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/service-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endpush
