<x-layout>
    <x-form title="Login" description="Glade to have you back!">
        <form action="login" method="POST" class="flex flex-col gap-y-3">
            @csrf
            <x-form.input type="email" name="email" id="login_email" title="Email" />
            <x-form.input type="password" name="password" id="login_password" title="Password" />

            <div class="">
                <button class="btn w-full h-10">
                    Login >
                </button>
            </div>
        </form>
    </x-form>
</x-layout>