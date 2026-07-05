<x-layout>
    <x-form title="Register an Account" description="Start tracking your ideas today!">
        <form action="/register" method="POST" class="flex flex-col gap-y-3">
            @csrf

            <x-form.input id="login_name" name="name" title="Name" type="text" />

            <x-form.input id="login_email" name="email" title="Email" type="email" />

            <x-form.input id="login_password" name="password" title="Password" type="password" />
    
            <div class="mt-3">
                <button class="btn w-full h-10" type="submit">
                    Register!
                </button>
            </div>
        </form>
    </x-form>
</x-layout>