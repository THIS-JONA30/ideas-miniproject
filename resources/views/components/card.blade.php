@props(['is' => 'a'])
<{{ $is }} {{ $attributes(['class' => 'flex flex-col justify-start items-start border border-border rounded-lg bg-card p-4 md:text-sm']) }}>
    {{ $slot }}
</{{ $is }}>