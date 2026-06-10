<div class="modal-header">
    <h5 class="modal-title">{{__('Create country')}}</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="countryForm" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <x-input-field label="{{ __(' Name') }}" name="name" value="{{ old('name' ) }}" required="true" col="12"
                maxLength="250" />


        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __(' Save') }}</button>
            </div>
        </div>
    </form>
</div>

