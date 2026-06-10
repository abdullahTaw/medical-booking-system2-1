<div class="modal-header">
    <h5 class="modal-title"> اضافة موعد </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="appointmentForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-select-field label="{{ __('Patient') }}" name="patient_id" :options="$patients"
                value="{{ old('patient_id') }}" required="true" />

            <x-select-field label="{{ __('Service') }}" name="service_id" :options="$services"
                value="{{ old('service_id') }}" required="true" />

            <x-input-field label="{{ __('Appointment Date') }}" name="appointment_date"
                value="{{ old('appointment_date') }}" required="true" type="date" />

            <x-input-field label="{{ __('Appointment Time') }}" name="appointment_time"
                value="{{ old('appointment_time') }}"  type="time" />

            <x-textarea-field label="{{ __('Notes') }}" name="notes" value="{{ old('notes') }}"
                height="70" />

        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
