@extends('layouts.dash_master')
@section('title')
<title>{{__('Create Category')}}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Edit Category')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('user.category.index') }}">{{__('Category List')}}</a></div>
              <div class="breadcrumb-item">{{__('Edit Category')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('user.category.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('Category List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                 {{-- //icon --}}
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{ __('user.Icon') }}<span class="text-danger">*</span></label>
                                        <input type='file' onchange="loadFile_image(icon)" name="icon" id="icon"
                                                class="@error('icon') is-invalid @enderror"
                                                style="display:none;"/>
                                        <button id="output_icon" type="button"
                                                onclick="document.getElementById('icon').click();" value="emad"
                                                style="
                                                    width: 150px;
                                                    height: 150px;
                                                    border-radius: 50%;
                                                    background-color: #cecbcb;
                                                    background-image: url({{ asset('storage/files/'.($category->icon ?? 'default.png')) }});
                                                    background-repeat: no-repeat;
                                                    background-size: cover;
                                                    background-position: center;
                                                    "/>
                                    </div>
                                </div>
                                <script>
                                var loadFile_image = function (image) {
                                    var image = document.getElementById('output_icon');
                                    var src = URL.createObjectURL(event.target.files[0]);
                                    image.style.backgroundImage = 'url(' + src + ')';
                                };
                                </script>

                                <div class="form-group col-12">
                                    <label>{{__('Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ old('name',($category->name))}}" required maxlength="200">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Name_en')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name_en" class="form-control"  name="name_en" value="{{ old('name_en',($category->name_en))}}" required maxlength="200">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('Main Category')}} <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control select2" id="category">
                                        <option value="0" {{ $category->category_id == 0 ? 'selected' : '' }}>{{__('main')}}</option>
                                        @foreach ($categories as $categ)
                                            @if ( $category->id != $categ->id )
                                            <option {{ $category->category_id == $categ->id ? 'selected' : '' }} value="{{ $categ->id }}">{{ $categ->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $category->status==1 ? 'selected': '' }} value="1">{{__('Active')}}</option>
                                        <option {{ $category->status==0 ? 'selected': '' }}  value="0">{{__('InActive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
        });
    })(jQuery);

    function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
        }
</script>
@endsection
