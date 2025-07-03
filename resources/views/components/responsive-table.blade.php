@props([
    'columns' => [],
    'items' => [],
    'actions' => [],
    'empty' => 'Không có dữ liệu.',
])

<x-alert-toastr></x-alert-toastr>

{{-- Desktop --}}
<table class="hidden md:table w-full divide-y divide-gray-200 dark:divide-gray-700 mt-6 text-sm">
    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold text-xs uppercase tracking-wider">
        <tr>
            <th class="px-6 py-3 text-left">STT</th> {{-- Thêm cột STT --}}
            @foreach ($columns as $column)
                <th class="px-6 py-3 text-left">{{ $column['label'] ?? $column['key'] }}</th>
            @endforeach
            @if ($actions)
                <th class="px-6 py-3 text-center">Hành động</th>
            @endif
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
        @forelse ($items as $index => $item) {{-- Sử dụng $index để lấy STT --}}
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <td class="px-6 py-5 text-gray-900 dark:text-white">{{ $index + 1 }}</td> {{-- Hiển thị STT --}}
                @foreach ($columns as $column)
                    <td class="px-6 py-5 text-gray-900 dark:text-white">
                        {{ data_get($item, $column['key']) }}
                    </td>
                @endforeach
                @if ($actions)
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            @foreach ($actions as $action)
                                <flux:button variant="{{ $action['variant'] ?? 'primary' }}" icon="{{ $action['icon'] ?? '' }}"
                                    wire:click="{{ $action['method'] }}({{ $item->id }})">
                                    {{ $action['label'] }}
                                </flux:button>
                            @endforeach
                        </div>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) + ($actions ? 1 : 0) + 1 }}" class="px-6 py-5 text-center text-gray-500">
                    {{ $empty }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


{{-- Mobile --}}
<div class="md:hidden space-y-4 mt-4">
    @forelse ($items as $index => $item) {{-- Sử dụng $index để lấy STT --}}
        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow border dark:border-gray-700">
            <div class="mb-2">
                <div class="text-xs text-gray-500 uppercase">STT</div> {{-- Thêm STT --}}
                <div class="text-gray-900 dark:text-white">
                    {{ $index + 1 }} {{-- Hiển thị STT --}}
                </div>
            </div>
            @foreach ($columns as $column)
                <div class="mb-2">
                    <div class="text-xs text-gray-500 uppercase">{{ $column['label'] ?? $column['key'] }}</div>
                    <div class="text-gray-900 dark:text-white">
                        {{ data_get($item, $column['key']) }}
                    </div>
                </div>
            @endforeach

            @if ($actions)
                <div class="flex justify-end gap-2 mt-4">
                    @foreach ($actions as $action)
                        <flux:button variant="{{ $action['variant'] ?? 'primary' }}" icon="{{ $action['icon'] ?? '' }}"
                            wire:click="{{ $action['method'] }}({{ $item->id }})">
                            {{ $action['label'] }}
                        </flux:button>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="text-center text-gray-500">{{ $empty }}</div>
    @endforelse
</div>

