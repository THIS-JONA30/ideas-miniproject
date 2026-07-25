@props(['idea' => new App\Models\Idea()])


{{-- Modal for creating your idea --}}
<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit Idea' : 'Create Idea' }}">
    <form 
        x-data="{
            status: @js(old('status', $idea->status->value)),
            newLink: '',
            links: @js(old('links', $idea->links ?? [])),

            newStep: '',
            steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'completed'])))
        }" 
        action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}" enctype="multipart/form-data" method="POST" class="">
        @csrf

        @if ($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-6">
            <x-form.input 
                type="text" 
                title="Idea Title" 
                name="title" 
                id="idea_title" 
                placeholder="Enter the title for the Idea" 
                :value="$idea->title" 
            required />

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

            <x-form.input 
                type="textarea" 
                title="Idea Description" 
                name="description" 
                id="idea_description" 
                placeholder="Enter the Description for the idea" 
                rows="5"
                :value="$idea->description"
            />

            {{-- Idea Image --}}
            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>

                @if ($idea->image_path)
                    <div class="overflow-none space-y-2">
                        <img src="{{ asset("storage/$idea->image_path") }}" alt="Featured Image" class="w-full h-auto object-cover rounded-lg">

                        <button class="btn btn-outlined h-10 w-full" form="removeImage">Remove Image</button>
                    </div>
                @endif

                <input type="file" accept="image/*" name="image" src="" alt="">
                <x-form.error name="image" />
            </div>

            {{-- Steps --}}
            <div class="">
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>

                    <template x-for="(step, index) in steps" :key="index">
                        <div class="flex justify-between items-center gap-x-2">
                            <input type="text" :name="`steps[${index}][description]`" x-model="step.description" class="input">
                            <input type="hidden" :name="`steps[${index}][completed]`" :value="step.completed ? '1' : '0'">

                            <button type="button" @click="steps.splice(index, 1)" class="btn bg-red-600">X</button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input type="text" name="" id="new-step" placeholder="Enter a step"  class="input flex-1" spellcheck="false"
                            x-model="newStep"
                        >

                        <button aria-label="add-idea-step" type="button" class="btn" 
                            @click="steps.push({description: newStep.trim(), completed: false }); newStep = '';"
                            :disabled="newStep.trim().length === 0"
                        >
                            +
                        </button>
                    </div>

                    {{-- <p x-text="steps"></p> --}}
                </fieldset>
            </div>

            {{-- Links --}}
            <div class="">
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>

                    <template x-for="(link, index) in links">
                        <div class="flex justify-between items-center gap-x-2">
                            <input type="text" name="links[]" id="" x-model="link" class="input">
                            <button type="button" @click="links.splice(index, 1)" class="btn bg-red-600">X</button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input type="url" name="" id="new-link" placeholder="http://example.com" autocomplete="url" class="input flex-1" spellcheck="false"
                            x-model="newLink"
                        >
                        <button aria-label="add-idea-link" type="button" class="btn" 
                            @click="links.push(newLink.trim()); newLink = '';"
                            :disabled="newLink.trim().length === 0"
                        >
                            +
                        </button>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="mt-3 flex justify-end items-center gap-x-3">
            <button type="reset" class="btn btn-outlined w-1/3 h-10" @click="$dispatch('close-modal')">
                Cancel
            </button>
            <button class="btn w-1/3 h-10">
                {{ $idea->exists ? 'Update' : 'Create' }}
            </button>

        </div>
    </form>

    @if ($idea->image_path)
        {{-- remove the Blog image form --}}
        <form action="{{ route('idea.destroyImage', $idea) }}" method="POST" id="removeImage">
            @csrf
            @method('DELETE')
        </form>
    @endif

</x-modal>