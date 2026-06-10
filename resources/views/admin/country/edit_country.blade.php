<div class="modal-header">
    <h5 class="modal-title"> Update {{$country->name}} </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="countryEditForm" data-id="{{$country->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <x-input-field label="{{ __('Name') }}" name="name" value="{{ old('name', $country->name ) }}" required="true"
                maxLength="250" />
        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
