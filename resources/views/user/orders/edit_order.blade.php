<div class="modal-header">
    <h5 class="modal-title"> طلب  </h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <form class="orderEditForm" data-id="{{$order->id}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <x-select-field label="{{ __('Status') }}" name="status" :options="[
            'scheduled'=>'scheduled',
            'completed'=>'completed',
            'cancelled'=>'cancelled',
        ]"
            value="{{ old('status',$order->status) }}" required="true" />

       <x-select-field label="{{ __('Gender') }}" name="gender" :options="[
                                                                                'male'=>'Male',
                                                                                'female'=>'Female'
                                                                            ]"
            value="{{ old('gender',$order->gender) }}" required="true" />

        <x-select-field label="{{ __('Service') }}" name="service_id" :options="$services"
            value="{{ old('service_id',$order->service_id) }}" required="true" />
            <x-input-field label="{{ __('Patient Name') }}" name="name"
            value="{{ old('name',$order->name) }}" required="true" type="text" />
            <x-input-field label="{{ __('Phone') }}" name="phone"
            value="{{ old('phone',$order->phone) }}" required="true" type="text" />
            <x-input-field label="{{ __('email') }}" name="email"
            value="{{ old('email',$order->email) }}" required="true" type="email" />
        <x-input-field label="{{ __('order Date') }}" name="appointment_date"
            value="{{ old('appointment_date',$order->appointment_date) }}" required="true" type="date" />

        <x-input-field label="{{ __('order Time') }}" name="appointment_time"
            value="{{ old('appointment_time',$order->appointment_time) }}"  type="time" />

        <x-textarea-field label="{{ __('Notes') }}" name="notes" value="{{ old('notes',$order->notes) }}"
            height="70" />
        </div>


        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>
