<div class="modal-header">
    <h5 class="modal-title"> Update {{$category->name}} </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="categoryEditForm" data-id="{{$category->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type='file' onchange="loadFile_image(image)" name="image" id="image"
                        class="@error('image') is-invalid @enderror" style="display:none;" />
                    <button id="output_image" type="button"
                        onclick="document.getElementById('image').click();"
                        style="width: 190px;
                                height: 120px;
                                border-radius: 0.357rem !important;
                                background-color: #cecbcb;
                                background-image: url({{ asset('storage/files/' . ($blog->image ?? 'default.png')) }});
                                background-repeat: no-repeat;
                                background-size: cover;
                                background-position: center;
                                " />
                </div>
                <label for="username">{{ __('Image') }}</label>
            </div>
            <script>
                var loadFile_image = function(image) {
                    var image = document.getElementById('output_image');
                    var src = URL.createObjectURL(event.target.files[0]);
                    image.style.backgroundImage = 'url(' + src + ')';
                };
            </script>
            <hr class="invoice-spacing">
            <x-input-field label="{{ __('Name') }}" name="name" value="{{ old('name', $category->name ) }}" required="true"
                maxLength="250" />

        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
