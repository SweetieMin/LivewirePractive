<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">Chức vụ</flux:heading>
    <flux:subheading size="lg" class="mb-6">Quản lý các chức vụ</flux:subheading>
    <flux:separator variant="subtle" />

    <flux:modal.trigger name="roles-create">
        <flux:button class="mt-4">Thêm chức vụ</flux:button>
    </flux:modal.trigger>

    <livewire:back.management.roles-create />

    <x-responsive-table :columns="[
        ['key' => 'name', 'label' => 'Tên chức vụ'],
        ['key' => 'description', 'label' => 'Mô tả'],
        ['key' => 'type', 'label' => 'Loại'],
        ['key' => 'createdBy.name', 'label' => 'Người tạo'],
    ]" :items="$roles" :actions="[
        ['label' => 'Sửa', 'method' => 'edit', 'icon' => 'square-pen', 'variant' => 'primary'],
        ['label' => 'Xóa', 'method' => 'delete', 'icon' => 'trash', 'variant' => 'danger'],
    ]" empty="Không có chức vụ nào." />

</div>
