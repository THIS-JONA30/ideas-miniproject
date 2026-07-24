@props(['type' => 'text', 'title' => false, 'name', 'id', 'placeholder' => '', 'value' => ''])

<div class="space-y-3">
    @if ($title)
        <label for="{{ $id }}" class="label">{{ $title }}</label>
    @endif

    @if ($type == 'textarea')
        <textarea 
        name="{{ $name }}" 
        id="{{ $id }}" 
        placeholder="{{ $placeholder }}" 
        {{ $attributes }} class="textarea">{{ old($name, $value) }}</textarea>
    @else
        <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        value="{{ old($name, $value) }}" 
        class="input" Placeholder="{{ $placeholder }}" {{ $attributes }}>
    @endif

    <x-form.error name="{{ $name }}" />
</div>