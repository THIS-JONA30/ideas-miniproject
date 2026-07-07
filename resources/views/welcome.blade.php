<x-layout>
    Index Page

    @session('success')
        <div
            x-data = "{show: true}"
            x-init = "setTimeout(() => show = false, 3000)"
            x-show = "show"
            x.transition.opacity.duration.5000ms
            class="absolute right-[20px] bottom-[20px] rounded-[12px] bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 p-3 py-1.5 text-xs font-semibold text-white shadow-lg shadow-emerald-500/20">
            {{ $value }}
        </div>
    @endsession
</x-layout>