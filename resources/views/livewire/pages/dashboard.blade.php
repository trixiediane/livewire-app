<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    @if ($user = auth()->user())
        @livewire('pages.post')
    @else
        @livewire('auth.register')
    @endif
</div>
