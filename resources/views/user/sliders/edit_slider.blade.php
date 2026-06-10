<div class="modal-header">
    <h5 class="modal-title"> تعديل {{ $slider->title }} </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="sliderEditForm"  data-id="{{ $slider->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <x-input-field label="{{ __('Title') }}" name="title" value="{{ old('title',$slider->title) }}" required="true"
                maxLength="250" />


            {{-- //image --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">{{ __('Image') }}</label>
                    <input type='file' onchange="loadFile_slider_image(slider_image)" name="slider_image"
                        id="slider_image" class="@error('slider_image') is-invalid @enderror" style="display:none;" />
                    <button id="output_slider_image" type="button"
                        onclick="document.getElementById('slider_image').click();" value="emad"
                        style="
                    width: 190px;
                    height: 100px;
                    border-radius: 5%;
                    background-image: url({{ asset('storage/files/' . ($slider->slider_image ?? 'default.png')) }});
                    background-color: #cecbcb;
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    " />
                </div>
            </div>
            <script>
                var loadFile_slider_image = function(slider_image1) {
                    var slider_image1 = document.getElementById('output_slider_image');
                    var src4 = URL.createObjectURL(event.target.files[0]);
                    slider_image1.style.backgroundImage = 'url(' + src4 + ')';
                };
            </script>

            <x-textarea-field label="{{ __('Description') }}" name="description" value="{{ old('description',$slider->description) }}"
                height="150" />

        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
