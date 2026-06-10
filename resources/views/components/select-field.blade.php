<div class="form-group col-{{$col}}">
    <label>{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-control"
        @if($required) required @endif
    >
        <option value="">{{ __('اختر من القائمة') }}</option>
        @foreach($options as $key => $option)
            <option value="{{ $key }}" @if($key == $value) selected @endif>{{ $option }}</option>
        @endforeach
    </select>
    <span class="error-{{$name}} text-danger"></span>
    @if($error)
        <span class="text-danger">{{ $error }}</span>
    @endif
</div>
