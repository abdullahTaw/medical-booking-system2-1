@extends('layouts.dash_master')
@section('title')
    <title>{{ __('messages') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Messages') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('messages') }}</div>
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
                                                <th>{{ __(' SN') }}</th>
                                                <th>{{ __(' Name') }}</th>
                                                <th>{{ __(' Email') }}</th>
                                                <th>{{ __('Subject') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($messages as $index => $message)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $message->name }}</td>
                                                    <td>{{ $message->email }}</td>
                                                    <td>{{ $message->subject }}</td>
                                                    <td>{{ $message->description }}</td>
                                                    <td>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $message->id }})"><i
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

@endsection
@push('js')
<script>

function deleteData(id)
   {
    $("#deleteForm").attr("action","{{ route('admin.message.destroy', ':id') }}".replace(':id', id))
   }
</script>
@endpush
