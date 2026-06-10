<div class="form-group col-{{ $col }}">
    <label>{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    <textarea
        id="{{ $name }}"
        class="form-control"
        name="{{ $name }}"
        maxlength="{{ $maxLength }}"
        style="height: {{$height}}px;"
        @if($required) required @endif
    > {{ old($name, $value) }} </textarea>
    <span class="error-{{ $name }} text-danger"></span>
    @if($error)
        <span class="text-danger">{{ $error }}</span>
    @endif
</div>
