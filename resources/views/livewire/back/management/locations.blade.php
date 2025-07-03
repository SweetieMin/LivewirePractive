<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Cơ cở</flux:heading>
    <flux:subheading size="lg" class="mb-6">Quản lý các cơ sở</flux:subheading>
    <flux:separator variant="subtle" />

    <flux:button class="mt-4" wire:click='add()'>Thêm cơ sở</flux:button>


    <flux:modal name="modal-location" class="w-full max-w-md md:max-w-2xl" >
        <form wire:submit.prevent="{{ $isUpdateMode ? 'update()' : 'create()'  }}" class="space-y-6">
            <div>
                <flux:heading size="lg" class="mb-4">{{ $isUpdateMode ? 'Cập nhật' : 'Thêm' }} cơ sở mới</flux:heading>
                <flux:separator />
            </div>

            @if ($isUpdateMode)
                <flux:input wire:model='locationId' hidden />
            @endif

            <flux:input label="Tên cơ sở" placeholder="Tên cơ sở" wire:model.live='name' autocomplete="off" />

            <flux:textarea label="Địa chỉ cơ sở" placeholder="Địa chỉ cơ sở" wire:model.live='address'
                autocomplete="off" />

            <div class="flex">
                <flux:spacer />
                @if ($hasChanges)
                    <flux:button type="submit" variant="primary">{{ $isUpdateMode ? 'Cập nhật' : 'Tạo' }} cơ sở</flux:button>
                @endif
            </div>
        </form>
    </flux:modal>

    <x-responsive-table :columns="[
        ['key' => 'name', 'label' => 'Tên cơ sở'],
        ['key' => 'address', 'label' => 'Địa chỉ'],
        ['key' => 'createdBy.name', 'label' => 'Người tạo'],
    ]" :items="$locations" :actions="[
        ['label' => 'Sửa', 'method' => 'edit', 'icon' => 'square-pen', 'variant' => 'primary'],
        ['label' => 'Xóa', 'method' => 'delete', 'icon' => 'trash', 'variant' => 'danger'],
    ]" empty="Không có cơ sở nào." />

    <div class="mt-4">
        {{ $locations->links() }}
    </div>

    {{-- Delete --}}

    <flux:modal name="locations-delete" class="min-w-[22rem]">
        <form wire:submit.prevent="deleteLocation" class="space-y-6">
            <div>
                <flux:heading size="lg">Xóa cơ sở?</flux:heading>

                <flux:text class="mt-2">
                    <p>Bạn có chắc muốn xóa cơ sở này không?</p>
                    <p>Thao tác này không thể hoàn tác.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Hủy</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger">Xác nhận</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
