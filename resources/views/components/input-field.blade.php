<div class="form-group col-{{ $col }}">
    <label>{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        class="form-control"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        maxlength="{{ $maxLength }}"
        @if($required) required @endif
    >
    <span class="error-{{ $name }} text-danger"></span>
    @if($error)
        <span class="text-danger">{{ $error }}</span>
    @endif
</div>
