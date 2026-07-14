@props(['type' => 'text', 'title', 'name', 'id', 'placeholder' => ''])

<div class="space-y-3">
    <label for="{{ $id }}" class="label">{{ $title }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name) }}" class="input" Placeholder="{{ $placeholder }}">
    @error($name)
        <span class="text-red-600">{{ $message }}</span>
    @enderror
</div>