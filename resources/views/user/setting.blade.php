@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dashashboard') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashSettings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('dashDashboard') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link active" id="general-setting-tab" data-toggle="tab" href="#generalSettingTab" role="tab"
                                                        aria-controls="generalSettingTab" aria-selected="true">{{ __('General Setting') }}</a>
                                                </li>
                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logoTab" role="tab" aria-controls="logoTab"
                                                        aria-selected="false">{{ __('overview and links') }}</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-9">
                                            <div class="border rounded">
                                                <div class="tab-content no-padding" id="settingsContent">
                                                    <!-- General Setting Tab Content -->
                                                    <div class="tab-pane fade show active" id="generalSettingTab" role="tabpanel" aria-labelledby="general-setting-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('user.update-general-setting') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row"><div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="username">{{ __('Center image') }}</label>
                                                                            <input type='file' onchange="loadFile_image(image)" name="center_logo" id="image"
                                                                                class="@error('center_logo') is-invalid @enderror" style="display:none;" />
                                                                            <button id="output_image" type="button" onclick="document.getElementById('image').click();"
                                                                                style="width: 200px;
                                                                                        height: 160px;
                                                                                        border-radius: 0.357rem !important;
                                                                                        background-image: url({{ asset('storage/files/' . $setting->center_logo) }});
                                                                                        background-color: #cecbcb;
                                                                                        background-repeat: no-repeat;
                                                                                        background-size: cover;
                                                                                        background-position: center;
                                                                                        " />
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        var loadFile_image = function(image) {
                                                                            var image = document.getElementById('output_image');
                                                                            var src = URL.createObjectURL(event.target.files[0]);
                                                                            image.style.backgroundImage = 'url(' + src + ')';
                                                                        };
                                                                    </script>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Center Name') }}</label>
                                                                                <input type="text" name="center_name" class="form-control"
                                                                                    value="{{ old('center_name', $setting->center_name ?? '') }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Category') }}</label>
                                                                                <select name="category_id" class="form-control select2">
                                                                                    <option value="">{{ __('Select Default category') }}</option>
                                                                                    @foreach ($categories as $category)
                                                                                        <option value="{{ $category->id }}"
                                                                                            {{ isset($setting->category_id) && $setting->category_id == $category->id ? 'selected' : '' }}>
                                                                                             {{ $category->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Country') }}</label>
                                                                                <select name="country_id" class="form-control select2">
                                                                                    <option value="">{{ __('Select Country') }}</option>
                                                                                    @foreach ($countries as $country)
                                                                                        <option value="{{ $country->id }}"
                                                                                            {{ isset($setting->country_id) && $setting->country_id == $country->id ? 'selected' : '' }}>
                                                                                             {{ $country->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('City') }}</label>
                                                                                <select name="city_id" class="form-control select2">
                                                                                    <option value="">{{ __('Select city') }}</option>
                                                                                    @foreach ($cities as $city)
                                                                                        <option value="{{ $city->id }}"
                                                                                            {{ isset($setting->city_id) && $setting->city_id == $city->id ? 'selected' : '' }}>
                                                                                             {{ $city->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Center Address') }}</label>
                                                                                <input type="text" name="center_address" class="form-control"
                                                                                    value="{{ old('center_address', $setting->center_address ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Center phone') }}</label>
                                                                                <input type="text" name="phone" class="form-control"
                                                                                    value="{{ old('phone', $setting->phone ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('longitude') }}</label>
                                                                                <input type="text" name="longitude" class="form-control"
                                                                                    value="{{ old('longitude', $setting->longitude ?? '' ) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('latitude') }}</label>
                                                                                <input type="text" name="latitude" class="form-control"
                                                                                    value="{{ old('latitude', $setting->latitude ?? '' ) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('Default Currency') }}</label>
                                                                                <select name="currency_id" class="form-control select2">
                                                                                    <option value="">{{ __('Select Default Currency') }}</option>
                                                                                    @foreach ($currencies as $currency)
                                                                                        <option value="{{ $currency->id }}"
                                                                                            {{ isset($setting->currency_id) && $setting->currency_id == $currency->id ? 'selected' : '' }}>
                                                                                            {{ $currency->symbol }} : {{ $currency->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="maintenance_mode" class="mr-3">{{ __('Maintenance Mode') }}</label>
                                                                                <input type="checkbox" name="maintenance_mode" value="1"
                                                                                    id="maintenance_mode" {{ isset($setting->maintenance_mode) && $setting->maintenance_mode == 1 ? 'checked' : '' }}>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Logo and Favicon Tab Content -->
                                                    <div class="tab-pane fade" id="logoTab" role="tabpanel" aria-labelledby="logo-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('user.update-general-setting') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('WhatsApp') }}</label>
                                                                                <input type="text" name="youtube_url" class="form-control"
                                                                                    value="{{ old('youtube_url', $setting->youtube_url ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('instagram') }}</label>
                                                                                <input type="text" name="instagram_url" class="form-control"
                                                                                    value="{{ old('instagram_url', $setting->instagram_url ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('facebook') }}</label>
                                                                                <input type="text" name="facebook_url" class="form-control"
                                                                                    value="{{ old('facebook_url', $setting->facebook_url ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">{{ __('twitter') }}</label>
                                                                                <input type="text" name="twitter_url" class="form-control"
                                                                                    value="{{ old('twitter_url', $setting->twitter_url ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mb-1">
                                                                            <label for="section1_content_en"> {{ __('overview') }}</label>
                                                                            <textarea name="overview" rows="10" id="overview" class="form-control">{!! $setting->overview ?? '' !!}</textarea>
                                                                        </div>
                                                                    </div>


                                                                    <button class="btn btn-primary">{{ __('Update Logo') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#overview'))
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
 </script>
@endpush
