<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex justify-between items-center">
        <div class="">
            <a href="/">
                <img src="{{ asset('images/logos/ideas-logo.png') }}" alt="Idea-Logo" width="150">
            </a>
        </div>

        @guest
            <div class="flex gap-x-5 items-center justify-center">
                <a href="/login">Sign In</a>
                <a href="/register" class="btn">Register</a>
            </div>
        @endguest

        @auth
            <div class="flex justify-center items-center gap-4">
                <a href="/profile/edit">My Profile</a>

                <form action="/logout" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>