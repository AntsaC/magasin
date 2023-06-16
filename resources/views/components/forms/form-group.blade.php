<div class="form-group">
    <label for="{{ $field }}">{{ ucfirst($field) }}</label>
    <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ isset($model) ? $model[$field] : old($field) }}" class="form-control @error($field) is-invalid @enderror" >
    @error($field)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
