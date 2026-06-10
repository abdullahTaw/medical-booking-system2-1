@extends('layouts.dash_master')
@section('title')
<title>{{ __('dashashboard') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('dashSettings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">{{ __('dashDashboard') }}</a>
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
                                                <a class="nav-link active" id="general-setting-tab" data-toggle="tab"
                                                    href="#generalSettingTab" role="tab">{{ __('General Setting') }}</a>
                                            </li>
                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link" id="logo-tab" data-toggle="tab"
                                                    href="#logoTab" role="tab">{{ __('overview and links') }}</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-9">
                                        <div class="border rounded">
                                            <form action="{{ route('admin.center.store') }}" method="POST" enctype="multipart/form-data">
                                                <div class="tab-content no-padding" id="settingsContent">

                                                    {{-- General Setting --}}
                                                    <div class="tab-pane fade show active" id="generalSettingTab" role="tabpanel">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                @csrf
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('User Name ') }}</label>
                                                                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Email') }}</label>
                                                                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="password">{{ __('Password') }}</label>
                                                                            <input type="password" id="password" name="password"
                                                                                class="form-control" required placeholder="********"
                                                                                autocomplete="new-password">
                                                                            @include('components.password-strength', ['inputId' => 'password'])
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="password_confirmation">{{ __('Confirm Password') }}*</label>
                                                                            <input id="password_confirmation" class="form-control" type="password"
                                                                                name="password_confirmation" required placeholder="********"
                                                                                autocomplete="new-password"/>
                                                                            @error('password_confirmation')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Center image') }}</label>
                                                                            <input type='file' onchange="loadFile_image(image)" name="center_logo"
                                                                                id="image" style="display:none;" />
                                                                            <button id="output_image" type="button"
                                                                                onclick="document.getElementById('image').click();"
                                                                                style="width:200px;height:160px;border-radius:0.357rem;
                                                                                background-color:#cecbcb;background-repeat:no-repeat;
                                                                                background-size:cover;background-position:center;border:none;display:block;"></button>
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
                                                                            <label>{{ __('Center Name') }}</label>
                                                                            <input type="text" name="center_name" class="form-control" value="{{ old('center_name') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Category') }}</label>
                                                                            <select name="category_id" class="form-control select2">
                                                                                <option value="">{{ __('Select Default category') }}</option>
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Country') }}</label>
                                                                            <select name="country_id" class="form-control select2">
                                                                                <option value="">{{ __('Select Country') }}</option>
                                                                                @foreach ($countries as $country)
                                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('City') }}</label>
                                                                            <select name="city_id" class="form-control select2">
                                                                                <option value="">{{ __('Select city') }}</option>
                                                                                @foreach ($cities as $city)
                                                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Center Address') }}</label>
                                                                            <input type="text" name="center_address" class="form-control" value="{{ old('center_address') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Center phone') }}</label>
                                                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
    <div class="form-group">
        <label for="license_number">
            {{ app()->getLocale() == 'ar' ? 'رقم الترخيص الحكومي' : 'Government License Number' }}
            <span class="text-danger">*</span>
        </label>
        <input type="text" id="license_number" name="license_number"
            class="form-control @error('license_number') is-invalid @enderror"
            value="{{ old('license_number') }}"
            placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل رقم الترخيص الرسمي' : 'Enter official license number' }}"
            required>
        @error('license_number')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <small class="text-muted">
            {{ app()->getLocale() == 'ar' ? 'رقم فريد لكل عيادة — لا يمكن تكراره' : 'Unique per clinic — cannot be duplicated' }}
        </small>
    </div>
</div>

{{-- ملف الترخيص --}}
<div class="col-md-6">
    <div class="form-group">
        <label for="license_file">
            {{ app()->getLocale() == 'ar' ? 'ملف الترخيص (PDF أو صورة)' : 'License File (PDF or Image)' }}
            <span class="text-danger">*</span>
        </label>
        <input type="file" id="license_file" name="license_file"
            class="form-control @error('license_file') is-invalid @enderror"
            accept=".pdf,.jpg,.jpeg,.png"
            required>
        @error('license_file')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <small class="text-muted">
            {{ app()->getLocale() == 'ar' ? 'مسموح: PDF, JPG, PNG — بحد أقصى 5MB' : 'Allowed: PDF, JPG, PNG — max 5MB' }}
        </small>
    </div>
</div>

                                                                    {{-- longitude -- عند الضغط تفتح الخريطة --}}
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('longitude') }}</label>
                                                                            <input type="text" id="longitude" name="longitude" class="form-control"
                                                                                value="{{ old('longitude') }}"
                                                                                placeholder="{{ app()->getLocale() == 'ar' ? 'انقر لتحديد الموقع' : 'Click to pick location' }}"
                                                                                readonly
                                                                                onclick="openMapModal('longitude')"
                                                                                style="cursor:pointer; background:#fff;">
                                                                        </div>
                                                                    </div>

                                                                    {{-- latitude -- عند الضغط تفتح الخريطة --}}
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('latitude') }}</label>
                                                                            <input type="text" id="latitude" name="latitude" class="form-control"
                                                                                value="{{ old('latitude') }}"
                                                                                placeholder="{{ app()->getLocale() == 'ar' ? 'انقر لتحديد الموقع' : 'Click to pick location' }}"
                                                                                readonly
                                                                                onclick="openMapModal('latitude')"
                                                                                style="cursor:pointer; background:#fff;">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Default Currency') }}</label>
                                                                            <select name="currency_id" class="form-control select2">
                                                                                <option value="">{{ __('Select Default Currency') }}</option>
                                                                                @foreach ($currencies as $currency)
                                                                                    <option value="{{ $currency->id }}">{{ $currency->symbol }} : {{ $currency->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Overview & Links --}}
                                                    <div class="tab-pane fade" id="logoTab" role="tabpanel">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('WhatsApp') }}</label>
                                                                            <input type="text" name="youtube_url" class="form-control" value="{{ old('youtube_url') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('instagram') }}</label>
                                                                            <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('facebook') }}</label>
                                                                            <input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('twitter') }}</label>
                                                                            <input type="text" name="twitter_url" class="form-control" value="{{ old('twitter_url') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <label>{{ __('overview') }}</label>
                                                                        <textarea name="overview" rows="10" id="overview" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary m-4">{{ __('Save') }}</button>
                                                </div>
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
            <button type="button" onclick="closeMapModal()"
                style="background:none;border:none;font-size:22px;cursor:pointer;color:#666;">&times;</button>
        </div>
        <p style="font-size:13px;color:#888;margin-bottom:10px;">
            {{ app()->getLocale() == 'ar' ? 'انقر على الخريطة لتحديد الموقع' : 'Click on the map to select a location' }}
        </p>
        <div id="map-picker" style="height:400px;border-radius:8px;border:1px solid #ddd;"></div>
        <div style="margin-top:12px;display:flex;justify-content:space-between;align-items:center;">
            <div id="map-coords" style="font-size:13px;color:#555;"></div>
            <button type="button" onclick="confirmLocation()" class="btn btn-primary btn-sm">
                {{ app()->getLocale() == 'ar' ? 'تأكيد الموقع' : 'Confirm Location' }}
            </button>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#overview'))
        .then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
            });
        }).catch(error => console.error(error));
</script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var mapInstance    = null;
var selectedMarker = null;
var selectedLat    = null;
var selectedLng    = null;

function openMapModal(field) {
    document.getElementById('mapModal').style.display = 'flex';

    if (!mapInstance) {
        var startLat = parseFloat(document.getElementById('latitude').value)  || 31.5;
        var startLng = parseFloat(document.getElementById('longitude').value) || 34.46;

        mapInstance = L.map('map-picker').setView([startLat, startLng], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(mapInstance);

        // إذا كانت هناك قيم سابقة ضع pin عليها
        if (document.getElementById('latitude').value && document.getElementById('longitude').value) {
            selectedLat = startLat;
            selectedLng = startLng;
            selectedMarker = L.marker([startLat, startLng]).addTo(mapInstance);
            updateCoordsText();
        }

        mapInstance.on('click', function(e) {
            selectedLat = e.latlng.lat.toFixed(6);
            selectedLng = e.latlng.lng.toFixed(6);
            if (selectedMarker) {
                selectedMarker.setLatLng(e.latlng);
            } else {
                selectedMarker = L.marker(e.latlng).addTo(mapInstance);
            }
            updateCoordsText();
        });
    } else {
        setTimeout(function(){ mapInstance.invalidateSize(); }, 100);
    }
}

function updateCoordsText() {
    if (selectedLat && selectedLng) {
        document.getElementById('map-coords').textContent =
            'Lat: ' + selectedLat + ' | Lng: ' + selectedLng;
    }
}

function confirmLocation() {
    if (!selectedLat || !selectedLng) {
        alert('{{ app()->getLocale() == "ar" ? "الرجاء تحديد موقع على الخريطة" : "Please select a location on the map" }}');
        return;
    }
    document.getElementById('latitude').value  = selectedLat;
    document.getElementById('longitude').value = selectedLng;
    closeMapModal();
}

function closeMapModal() {
    document.getElementById('mapModal').style.display = 'none';
}

document.getElementById('mapModal').addEventListener('click', function(e) {
    if (e.target === this) closeMapModal();
});
</script>
@endpush
