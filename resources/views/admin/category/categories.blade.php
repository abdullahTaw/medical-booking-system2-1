@extends('layouts.dash_master')
@section('title')
    <title>{{ __('Categories') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Categories') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Categories') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a href="#" class="btn btn-primary create_category"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
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
                                                <th>{{ __(' Image') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $index => $category)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td><img width="50px" src="{{ asset('storage/files/' . ($category->image ?? 'default.png')) }}"></td>

                                                    <td>
                                                        @if ($category->status == 'active')
                                                            <a href="javascript:;"
                                                                onclick="changecategoryStatus({{ $category->id }})">
                                                                <input id="status_toggle" type="checkbox" checked
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changecategoryStatus({{ $category->id }})">
                                                                <input id="status_toggle" type="checkbox"
                                                                    data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm" id="category-edit" data-id="{{ $category->id }}"><i
                                                            class="fa fa-edit" aria-hidden="true" ></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $category->id }})"><i
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
        $('.create_category').on('click', function() {

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: "{{ route('admin.category.create') }}",
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

        //categoryForm submit
        $(document).on('submit', '.categoryForm', function(e) {
            e.preventDefault();

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.category.store') }}",
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

//جلب بيانات تعديل الcategory
        $(document).on('click', '#category-edit', function(e) {
            var categoryId = $(this).data('id'); // Get ID

                $.ajax({
                    url: "{{ route('admin.category.edit', ':id') }}".replace(':id', categoryId),
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


        //categoryEditForm submit
        $(document).on('submit', '.categoryEditForm', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('id'); // Get ID

            // مسح الأخطاء السابقة
            $('.text-danger').text('');
            let form = this;
            let formData = new FormData(form);

            formData.append('_token', $('input[name="_token"]').val());
            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('admin.category.update', ':id') }}".replace(':id', categoryId),
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
        $("#deleteForm").attr("action","{{ route('admin.category.destroy', ':id') }}".replace(':id', id))
        }
///change category Status
        function changecategoryStatus(id){
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{ route('admin.category.status', ':id') }}".replace(':id', id),
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endpush
