<div class="modal-header">
    <h5 class="modal-title"> Update {{$city->name}} </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="cityEditForm" data-id="{{$city->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <x-select-field label="{{ __('country') }}" required="true" name="country_id" :options="$countries"
            value="{{ old('country_id', $city->country_id) }}" />
            <x-input-field label="{{ __('Name') }}" name="name" value="{{ old('name', $city->name ) }}" required="true"
                maxLength="250" />
        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
