<div class="modal-header">
    <h5 class="modal-title"> تعديل {{$service->name}} </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="serviceEditForm" data-id="{{$service->id}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-input-field label="{{ __('Name') }}" name="name" value="{{ old('name', $service->name ) }}" required="true"
                maxLength="250" />
            <x-input-field label="{{ __('Price') }}" name="price" value="{{ old('price', $service->price ) }}"
                maxLength="11" type="number" />
                <x-input-field label="{{ __('duration') }}" name="duration" value="{{ old('duration', $service->duration ) }}"
                    maxLength="11" type="number" />
            <x-textarea-field label="{{ __('Description') }}" name="description" value="{{ old('description', $service->description ) }}" height="150" />

        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
