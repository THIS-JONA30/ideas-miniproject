<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-2">
            <a href="{{ route('idea.index') }}" class="btn btn-outlined">Back to Home</a>

            <div class="flex justify-between items-center gap-2">
                <a href="" class="btn">Edit Idea</a>
                <form action="{{ route('idea.delete', $idea) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outlined text-red-500">
                        Delete Idea
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4 space-y-2">
            <div class="rounded-lg overflow-hidden">
                @if ($idea->image_path)
                    <img src="{{ asset("storage/$idea->image_path") }}" alt="Featured Image" class="w-full h-auto object-cover">
                @endif
            </div>

            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>
    
            <div class="mt-2 flex gap-3 items-center">
                <x-idea.status-label :status=" $idea->status->value ">
                    {{ $idea->status->label() }}
                </x-idea.status-label>
    
    
                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>
    
            <x-card class="mt-4">
                <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
            </x-card>
    
            @if ($idea->steps->count())
                <div class="">
                    <h3 class="font-bold text-xl mt-6">Actionable Steps</h3>
    
                    <div class="mt-3 space-y-2">
                        @foreach ($idea->steps as $step)
                            <x-card is="div" class="text-primary font-medium flex gap-3 items-center">
                                <form action="{{ route('step.update', $step) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="flex items-center justify-start gap-x-3 w-full">
                                        <button type="submit" role="checkbox" class="size-5 flex items-center justify-center rounded-lg text-primary-foreground border border-primary {{ ($step->completed)? 'bg-primary' : '' }}">&check;</button>
                                        <span class=" {{ ($step->completed)? 'line-through text-muted-foreground' : 'text-white' }}">{{ $step->description }}</span>
                                    </div>
                                </form>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
    
            @if ($idea->links)
                <div class="">
                    <h3 class="font-bold text-xl mt-6">Links</h3>
    
                    <div class=" mt-3 flex flex-col justify-start items-start gap-y-3">
                        @foreach ($idea->links as $link)
                            <x-card is="button" href="{{ $link }}" class="text-primary font-medium flex gap-3 items-center w-full">
                                {{ $link }}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>