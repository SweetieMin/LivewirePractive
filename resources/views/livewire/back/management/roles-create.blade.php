<div>
    <flux:modal name="roles-create" class="w-full max-w-md md:max-w-2xl">
        <form wire:submit.prevent="save" class="space-y-6">
            <div>
                <flux:heading size="lg" class="mb-4">Thêm chức vụ mới</flux:heading>
                <flux:separator />
            </div>

            <flux:input label="Tên chức vụ" placeholder="Tên chức vụ" wire:model.live='name' autocomplete="off"/>

            <flux:textarea label="Mô tả chức vụ" placeholder="Mô tả chức vụ" wire:model.live='description' autocomplete="off"/>

            <div class="flex">
                <flux:spacer />
                @if ($hasChanges)
                    <flux:button type="submit" variant="primary">Tạo chức vụ</flux:button>
                @endif
            </div>
        </form>
    </flux:modal>
</div>
