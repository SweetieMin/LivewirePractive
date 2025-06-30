<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Cơ cở</flux:heading>
    <flux:subheading size="lg" class="mb-6">Quản lý các cơ sở</flux:subheading>
    <flux:separator variant="subtle" />

    <flux:modal.trigger name="locations-create">
        <flux:button class="mt-4">Thêm cơ sở</flux:button>
    </flux:modal.trigger>

    @include('components.alert-toastr')

    <livewire:back.management.locations-create />

    <table class="table-auto w-full rounded-lg mt-5 ">
        <thead>
            <tr>
                <th class="px-4 py2 text-left">Tên cơ sở</th>
                <th class="px-4 py2 text-left">Địa chỉ</th>
                <th class="px-4 py2 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $locations as $location )
                <tr>
                    <td class="px-4 py-2">{{ $location->name }}</td>
                    <td class="px-4 py-2">{{ $location->address }}</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <flux:button variant="primary">
                            Sửa
                        </flux:button>
                        <flux:button variant="danger" >
                            Xóa
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center">Không có cơ sở nào.</td>
                </tr>
            @endforelse
        </tbody>

    </table>
    <div class="mt-4">
        {{ $locations->links() }}   
    </div>
</div>
