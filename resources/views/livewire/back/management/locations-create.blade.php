<div>
    <flux:modal name="locations-create" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="mb-4">Thêm cơ sở mới</flux:heading>
                <flux:separator />
            </div>

            <flux:input label="Tên cơ sở" placeholder="Tên cơ sở" wire:model='name'/>

            <flux:textarea label="Địa chỉ cơ sở" placeholder="Địa chỉ cơ sở" wire:model='address'/>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click='save'>Tạo cơ sở</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
