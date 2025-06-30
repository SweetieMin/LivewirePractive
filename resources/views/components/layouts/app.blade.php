<x-layouts.app.sidebar :title="$title ?? null">
    @include('components.alert-toastr')
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
