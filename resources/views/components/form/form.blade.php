@props(['title', 'description'])

<div class="flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold tracking-tight">{{ $title }}</h1>
            <p class="text-muted-foreground mt-1">{{ $description }}</p>
        </div>

        {{ $slot }}
        
    </div>
</div>