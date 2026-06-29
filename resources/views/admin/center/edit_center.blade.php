@extends('layouts.dash_master')
@section('title')
<title>{{ __('dashashboard') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('dashSettings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('dashDashboard') }}</a>
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
                                                            <form action="{{ route('admin.center.update',$center->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="username">{{ __('Center image') }}</label>
                                                                            <input type='file' onchange="loadFile_image(image)" name="center_logo" id="image"
                                                                                class="@error('center_logo') is-invalid @enderror" style="display:none;" />
                                                                            <button id="output_image" type="button" onclick="document.getElementById('image').click();"
                                                                                style="width: 200px;
                                                                                        height: 160px;
                                                                                        border-radius: 0.357rem !important;
                                                                                        background-image: url({{ asset('storage/files/' . $center->center_logo) }});
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
                                                                                value="{{ old('center_name', $center->center_name ?? '') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('Category') }}</label>
                                                                            <select name="category_id" class="form-control select2">
                                                                                <option value="">{{ __('Select Default category') }}</option>
                                                                                @foreach ($categories as $category)
                                                                                <option value="{{ $category->id }}"
                                                                                    {{ isset($center->category_id) && $center->category_id == $category->id ? 'selected' : '' }}>
                                                                                    {{ $category->name }}
                                                                                </option>
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
                                                                                    {{ isset($center->country_id) && $center->country_id == $country->id ? 'selected' : '' }}>
                                                                                    {{ $country->name }}
                                                                                </option>
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
                                                                                    {{ isset($center->city_id) && $center->city_id == $city->id ? 'selected' : '' }}>
                                                                                    {{ $city->name }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('Center Address') }}</label>
                                                                            <input type="text" name="center_address" class="form-control"
                                                                                value="{{ old('center_address', $center->center_address ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('Center phone') }}</label>
                                                                            <input type="text" name="phone" class="form-control"
                                                                                value="{{ old('phone', $center->phone ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('longitude') }}</label>
                                                                            <input
                                                                                type="text"
                                                                                id="longitude"
                                                                                name="longitude"
                                                                                class="form-control"
                                                                                value="{{ old('longitude', $center->longitude ?? '') }}"
                                                                                placeholder="{{ app()->getLocale() == 'ar' ? 'انقر لتحديد الموقع' : 'Click to pick location' }}"
                                                                                readonly
                                                                                onclick="openMapModal()"
                                                                                style="cursor:pointer;background:#fff;">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('latitude') }}</label>
                                                                            <input
                                                                                type="text"
                                                                                id="latitude"
                                                                                name="latitude"
                                                                                class="form-control"
                                                                                value="{{ old('latitude', $center->latitude ?? '') }}"
                                                                                placeholder="{{ app()->getLocale() == 'ar' ? 'انقر لتحديد الموقع' : 'Click to pick location' }}"
                                                                                readonly
                                                                                onclick="openMapModal()"
                                                                                style="cursor:pointer;background:#fff;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('Default Currency') }}</label>
                                                                            <select name="currency_id" class="form-control select2">
                                                                                <option value="">{{ __('Select Default Currency') }}</option>
                                                                                @foreach ($currencies as $currency)
                                                                                <option value="{{ $currency->id }}"
                                                                                    {{ isset($center->currency_id) && $center->currency_id == $currency->id ? 'selected' : '' }}>
                                                                                    {{ $currency->symbol }} : {{ $currency->name }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="maintenance_mode" class="mr-3">{{ __('Maintenance Mode') }}</label>
                                                                            <input type="checkbox" name="maintenance_mode" value="1"
                                                                                id="maintenance_mode" {{ isset($setting->maintenance_mode) && $center->maintenance_mode == 1 ? 'checked' : '' }}>
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
                                                                                value="{{ old('youtube_url', $center->youtube_url ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('instagram') }}</label>
                                                                            <input type="text" name="instagram_url" class="form-control"
                                                                                value="{{ old('instagram_url', $center->instagram_url ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('facebook') }}</label>
                                                                            <input type="text" name="facebook_url" class="form-control"
                                                                                value="{{ old('facebook_url', $center->facebook_url ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('twitter') }}</label>
                                                                            <input type="text" name="twitter_url" class="form-control"
                                                                                value="{{ old('twitter_url', $center->twitter_url ?? '') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <label for="section1_content_en"> {{ __('overview') }}</label>
                                                                        <textarea name="overview" rows="10" id="overview" class="form-control">{!! $center->overview ?? '' !!}</textarea>
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
{{-- ===== Map Modal ===== --}}
<div id="mapModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
    background:rgba(0,0,0,0.6);z-index:9999;justify-content:center;align-items:center;">
    <div style="background:#fff;border-radius:10px;width:700px;max-width:95%;padding:20px;position:relative;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
            <h5 style="margin:0;">
                {{ app()->getLocale() == 'ar' ? 'اختر موقع المركز' : 'Select Clinic Location' }}
            </h5>

            <button type="button"
                    onclick="closeMapModal()"
                    style="background:none;border:none;font-size:22px;cursor:pointer;color:#666;">
                &times;
            </button>
        </div>

        <p style="font-size:13px;color:#888;margin-bottom:10px;">
            {{ app()->getLocale() == 'ar' ? 'انقر على الخريطة لتحديد الموقع' : 'Click on the map to select a location' }}
        </p>

        <div id="map-picker"
             style="height:400px;border-radius:8px;border:1px solid #ddd;">
        </div>

        <div style="margin-top:12px;display:flex;justify-content:space-between;align-items:center;">
            <div id="map-coords" style="font-size:13px;color:#555;"></div>

            <button type="button"
                    onclick="confirmLocation()"
                    class="btn btn-primary btn-sm">
                {{ app()->getLocale() == 'ar' ? 'تأكيد الموقع' : 'Confirm Location' }}
            </button>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

    let map;
    let marker;

    function openMapModal() {

        document.getElementById('mapModal').style.display = 'flex';

        setTimeout(function() {

            let lat = parseFloat(document.getElementById('latitude').value) || 32.2211;
            let lng = parseFloat(document.getElementById('longitude').value) || 35.2544;

            if (!map) {

                map = L.map('map-picker').setView([lat, lng], 13);

                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        attribution: '&copy; OpenStreetMap contributors'
                    }
                ).addTo(map);

                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);

                document.getElementById('map-coords').innerHTML =
                    lat.toFixed(6) + ' , ' + lng.toFixed(6);

                marker.on('dragend', function() {

                    let position = marker.getLatLng();

                    document.getElementById('latitude').value =
                        position.lat.toFixed(6);

                    document.getElementById('longitude').value =
                        position.lng.toFixed(6);

                    document.getElementById('map-coords').innerHTML =
                        position.lat.toFixed(6) + ' , ' + position.lng.toFixed(6);
                });

                map.on('click', function(e) {

                    marker.setLatLng(e.latlng);

                    document.getElementById('latitude').value =
                        e.latlng.lat.toFixed(6);

                    document.getElementById('longitude').value =
                        e.latlng.lng.toFixed(6);

                    document.getElementById('map-coords').innerHTML =
                        e.latlng.lat.toFixed(6) + ' , ' + e.latlng.lng.toFixed(6);
                });

            } else {

                map.invalidateSize();

                if (
                    document.getElementById('latitude').value &&
                    document.getElementById('longitude').value
                ) {

                    let newLat =
                        parseFloat(document.getElementById('latitude').value);

                    let newLng =
                        parseFloat(document.getElementById('longitude').value);

                    map.setView([newLat, newLng], 13);

                    if (marker) {
                        marker.setLatLng([newLat, newLng]);
                    }
                }
            }

        }, 300);
    }

    function closeMapModal() {
        document.getElementById('mapModal').style.display = 'none';
    }

    function confirmLocation() {
        closeMapModal();
    }

</script>
