<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

        <x-card class="mt-4">
            <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
        </x-card>
    </div>
</x-layout>