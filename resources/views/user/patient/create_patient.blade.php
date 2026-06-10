<div class="modal-header">
    <h5 class="modal-title"> جديد </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="patientForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-input-field label="{{ __('Name') }}" name="name" value="{{ old('name') }}" required="true"
                maxLength="250" />
            <x-input-field label="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}" required="true"
                maxLength="11" type="number" />
            <x-input-field label="{{ __('Email') }}" name="email" value="{{ old('email') }}" required="true"
                type="email" />
            <x-select-field label="{{ __('Gender') }}" name="gender" :options="[
                'male' => 'Male',
                'female' => 'Female',
            ]" value="{{ old('gender') }}"
                required="true" />

            <x-input-field label="{{ __('Date of birth') }}" name="date_of_birth"
                value="{{ old('date_of_birth') }}" required="true" type="date" />

            <x-select-field label="{{ __('Country') }}" required="true" name="country" :options="$countries"
                value="{{ old('country') }}" />
            <x-select-field label="{{ __('City') }}" name="city" value="{{ old('city') }}" />

            <x-input-field label="{{ __('Address') }}" name="address" required="true"
            value="{{ old('address') }}" type="text" />

            <x-textarea-field label="{{ __('Medical History') }}" name="medical_history" value="{{ old('medical_history') }}" height="150" />

            <x-input-field label="{{ __('Blood Type') }}" name="blood_type"
            value="{{ old('blood_type') }}" type="text" />

            <x-textarea-field label="{{ __('Allergies') }}" name="allergies" value="{{ old('allergies') }}" height="70" />

        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
