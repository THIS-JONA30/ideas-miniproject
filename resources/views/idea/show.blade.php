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

        @if ($idea->links)
            <div class="">
                <h3 class="font-bold text-xl mt-6">Links</h3>

                <div class="flex flex-col justify-start items-center gap-y-3">
                    @foreach ($idea->links as $link)
                        <x-card href="{{ $link }}" class="text-primary font-medium flex gap-3 items-center">
                            {{ $link }}
                        </x-card>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>