@props(['status' => 'pending'])
@php
    $classes = 'inline-block rounded-full border px-2 py-1 text-xs font-medium';

    if($status == 'pending'){
        $classes .= 'bg-yellow-500/50 text-yellow-500 border-yellow-500/20';
    } elseif($status == 'in_progress'){
        $classes .= 'bg-blue-500/10 text-blue-500 border-blue-500/50';
    } else {
        $classes .= 'bg-primary/10 text-primary border-primary/50';
    }
@endphp


<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>