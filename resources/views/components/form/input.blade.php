@props(['type' => 'text', 'title' => false, 'name', 'id', 'placeholder' => ''])

<div class="space-y-3">
    @if ($title)
        <label for="{{ $id }}" class="label">{{ $title }}</label>
    @endif

    @if ($type == 'textarea')
        <textarea name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" {{ $attributes }} class="textarea">{{ old($name) }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ old($name) }}" class="input" Placeholder="{{ $placeholder }}" {{ $attributes }}>
    @endif

    <x-form.error name="{{ $name }}" />
</div>