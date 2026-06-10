@extends('layouts.dash_master')
@section('title')
<title>{{ __('centers') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Centers') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">{{ __('Centers') }}</div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.center.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __('Add New') }}
            </a>

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
                                            <th>{{ app()->getLocale() == 'ar' ? 'رقم الترخيص' : 'License No.' }}</th>
                                            <th>{{ app()->getLocale() == 'ar' ? 'حالة التوثيق' : 'License Status' }}</th>
                                            <th>{{ app()->getLocale() == 'ar' ? 'ملف الترخيص' : 'License File' }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($centers as $index => $center)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $center->center_name }}</td>
                                            <td>
                                                <img width="50px"
                                                    src="{{ asset('storage/files/' . ($center->center_logo ?? 'default.png')) }}">
                                            </td>

                                            {{-- حالة العيادة --}}
                                            <td>
                                                <a href="javascript:;" onclick="changecenterStatus({{ $center->id }})">
                                                    <input type="checkbox"
                                                        {{ $center->status == 'active' ? 'checked' : '' }}
                                                        data-toggle="toggle"
                                                        data-on="{{ __('Active') }}"
                                                        data-off="{{ __('Inactive') }}"
                                                        data-onstyle="success"
                                                        data-offstyle="danger">
                                                </a>
                                            </td>

                                            {{-- رقم الترخيص --}}
                                            <td>{{ $center->license_number ?? '—' }}</td>

                                            {{-- حالة التوثيق --}}
                                            <td>
                                                @if($center->license_status == 'approved')
                                                    <span class="badge badge-success">
                                                        {{ app()->getLocale() == 'ar' ? 'موثقة ✓' : 'Approved ✓' }}
                                                    </span>
                                                @elseif($center->license_status == 'rejected')
                                                    <span class="badge badge-danger">
                                                        {{ app()->getLocale() == 'ar' ? 'مرفوضة ✗' : 'Rejected ✗' }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">
                                                        {{ app()->getLocale() == 'ar' ? 'قيد المراجعة' : 'Pending' }}
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- ملف الترخيص + أزرار الموافقة --}}
                                            <td>
                                                @if($center->license_file)
                                                    {{-- عرض الملف --}}
                                                    <a href="{{ asset('storage/files/' . $center->license_file) }}"
                                                        target="_blank"
                                                        class="btn btn-info btn-sm"
                                                        title="{{ app()->getLocale() == 'ar' ? 'عرض الترخيص' : 'View License' }}">
                                                        <i class="fas fa-file-alt"></i>
                                                    </a>

                                                    {{-- موافقة --}}
                                                    @if($center->license_status !== 'approved')
                                                    <a href="javascript:;"
                                                        onclick="approveLicense({{ $center->id }})"
                                                        class="btn btn-success btn-sm"
                                                        title="{{ app()->getLocale() == 'ar' ? 'موافقة' : 'Approve' }}">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    @endif

                                                    {{-- رفض --}}
                                                    @if($center->license_status !== 'rejected')
                                                    <a href="javascript:;"
                                                        onclick="rejectLicense({{ $center->id }})"
                                                        class="btn btn-danger btn-sm"
                                                        title="{{ app()->getLocale() == 'ar' ? 'رفض' : 'Reject' }}">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>

                                            {{-- أزرار التعديل والحذف --}}
                                            <td>
                                                <a href="{{ route('admin.center.edit', $center->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;"
                                                    data-toggle="modal"
                                                    data-target="#deleteModal"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="deleteData({{ $center->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
    function deleteData(id) {
        $("#deleteForm").attr("action", "{{ route('admin.center.destroy', ':id') }}".replace(':id', id));
    }

    function changecenterStatus(id) {
        $.ajax({
            type: "put",
            data: { _token: '{{ csrf_token() }}' },
            url: "{{ route('admin.center.status', ':id') }}".replace(':id', id),
            success: function(response) { toastr.success(response); },
            error: function(err) {}
        });
    }

    function approveLicense(id) {
        if (!confirm('{{ app()->getLocale() == "ar" ? "هل توافق على هذا الترخيص؟" : "Approve this license?" }}')) return;
        $.ajax({
            type: "GET",
            url: "{{ route('admin.center.approve-license', ':id') }}".replace(':id', id),
            success: function(response) {
                toastr.success(response);
                setTimeout(function(){ location.reload(); }, 1000);
            },
            error: function() { toastr.error('Error'); }
        });
    }

    function rejectLicense(id) {
        if (!confirm('{{ app()->getLocale() == "ar" ? "هل تريد رفض هذا الترخيص؟" : "Reject this license?" }}')) return;
        $.ajax({
            type: "GET",
            url: "{{ route('admin.center.reject-license', ':id') }}".replace(':id', id),
            success: function(response) {
                toastr.warning(response);
                setTimeout(function(){ location.reload(); }, 1000);
            },
            error: function() { toastr.error('Error'); }
        });
    }
</script>
@endpush
