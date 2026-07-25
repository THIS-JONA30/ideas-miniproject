<x-layout>
    <x-form title="Edit your profile" description="Make a tweak!">
        <form action="{{ route('profile.update') }}" method="POST" class="flex flex-col gap-y-3">
            @csrf
            @method('PATCH')

            <x-form.input id="login_name" name="name" title="Name" type="text" :value="$user->name"/>

            <x-form.input id="login_email" name="email" title="Email" type="email" :value="$user->email"/>

            <x-form.input id="login_password" name="password" title="New Password" type="password" />
    
            <div class="mt-3">
                <button class="btn w-full h-10" type="submit">
                    Update!
                </button>
            </div>
        </form>
    </x-form>
</x-layout>