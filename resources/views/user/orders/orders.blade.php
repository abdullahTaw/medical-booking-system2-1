@extends('layouts.dash_master')
@section('title')
    <title>{{ __('orders') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('orders') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('Aashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('orders') }}</div>
                </div>
            </div>
            <div class="section-body">
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
                                                <th>{{ __('Service') }}</th>
                                                <th>{{ __('Patient Name') }}</th>
                                                <th>{{ __('Phone') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $index => $order)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $order->appointment_date }}</td>
                                                    <td>{{ $order->service->name ?? '' }}</td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>
                                                        @if ($order->status)
                                                        <span class="text-info">{{$order->status}}</span></td>
                                                        @else
                                                        <span class="text-success">Completed</span></td>

                                                        @endif
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" id="order-edit" data-id="{{ $order->id }}"><i
                                                                class="fa fa-edit" aria-hidden="true" ></i></a>
                                                                <a href="#" class="btn btn-secondary btn-sm" id="order-edit" data-id="{{ $order->id }}"><i
                                                                    class="fa fa-eye" aria-hidden="true" ></i></a>
                                                                    <a href="#" class="btn btn-success btn-sm" id="order-edit" data-id="{{ $order->id }}"><i
                                                                        class="fa fa-phone" aria-hidden="true" ></i></a>
                                                                        <a href="#" class="btn btn-warning btn-sm" id="order-edit" data-id="{{ $order->id }}"><i
                                                                            class="fa fa-paper-plane" aria-hidden="true" ></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $order->id }})"><i
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
//جلب بيانات تعديل الorder
        $(document).on('click', '#order-edit', function(e) {
            var orderId = $(this).data('id'); // Get ID

                $.ajax({
                    url: '/order/'+ orderId + '/edit' ,
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


        //orderEditForm submit
        $(document).on('submit', '.orderEditForm', function(e) {
            e.preventDefault();
            var orderId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/order/'+ orderId,
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
                        if (errors.order_date) {
                            $('.error-order_date').text(errors.order_date[0]);
                        }
                        if (errors.order_time) {
                            $('.error-order_time').text(errors.order_time[0]);
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
