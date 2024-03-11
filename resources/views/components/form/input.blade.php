@props(['name', 'label', 'value' => ''])
<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="text" name="{{ $name}}" value="{{ $value }}" class="form-control">
</div>