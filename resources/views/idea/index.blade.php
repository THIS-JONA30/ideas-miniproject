<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>

        {{-- Status Filter --}}
        <div class="mt-5 flex justify-start items-center gap-4">
            <a href="{{ url('/ideas') }}" class="btn {{ empty(request('status'))? '' : 'btn-outlined' }}">All <span class="text-sm pl-3">{{ $count->get('all') }}</span> </a>
            @foreach (app\IdeaStatus::cases() as $status)
                <a href="{{ url('/ideas?status=' . $status->value) }}" 
                    class="btn {{ (request('status') === $status->value)? '' : 'btn-outlined' }}">
                    {{ $status->label() }}
                    <span class="text-xs pl-3">{{ ($count->get($status->value)) }}</span>
                </a>
            @endforeach

            {{-- <a href="{{ url('/ideas?status=in_progress') }}" class="">In Progress</a>
            <a href="{{ url('/ideas?status=completed') }}" class="">Completed</a> --}}
        </div>

        <div class="mt-3 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea->id) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>

                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>


                        <p class="mt-5 line-clamp-3">{{ $idea->description }}</p>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No Ideas at this time</p>
                    </x-card>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>