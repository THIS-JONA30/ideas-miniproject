<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <div class="">
                <h1 class="text-3xl font-bold">Ideas</h1>
                <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
            </div>

            <x-card 
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button" class="w-full mt-10 space-y-3 cursor-pointer h-12">
                <p>Create Idea</p>
            </x-card>
        </header>
        <div class="">
        </div>

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


        {{-- Modal for creating your idea --}}
        <x-modal name="create-idea" title="Create a new idea">
            <form x-data="{status: 'pending'}" action="{{ route('idea.store') }}" method="POST" class="">
                @csrf
                <div class="space-y-6">
                    <x-form.input type="text" title="Idea Title" name="title" id="idea_title" placeholder="Enter the title for the Idea" required />

                    <div class="space-y-2">
                        <label for="status" class="label ">Status</label>

                        <div class="flex gap-x-3">
                            @foreach (app\IdeaStatus::cases() as $status)
                                <button
                                    type="button" 
                                    @click="status = @js($status->value)"
                                    class="btn flex-1 h-10"
                                    :class="status === @js($status->value)? '' : 'btn-outlined'"
                                >
                                    {{ $status->label() }}
                                </button>
                            @endforeach

                            <input type="hidden" name="status" :value="status">
                        </div>

                        <x-form.error name="status" />
                    </div>

                    <x-form.input type="textarea" title="Idea Description" name="description" id="idea_description" placeholder="Enter the Description for the idea" rows="5"/>

                    <x-form.input type="text" title="Idea links" name="links" id="idea_links" placeholder="Enter the Links for your idea"/>
                </div>

                <div class="mt-3 flex justify-end items-center gap-x-3">
                    <button type="reset" class="btn btn-outlined w-1/3 h-10" @click="$dispatch('close-modal')">
                        Cancel
                    </button>
                    <button class="btn w-1/3 h-10">
                        Create
                    </button>

                </div>
            </form>
        </x-modal>
    </div>
</x-layout>