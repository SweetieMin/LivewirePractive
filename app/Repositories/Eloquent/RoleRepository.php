<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RoleRepository implements RoleRepositoryInterface
{
    protected array $roleCache = [];

    protected function prepareDataBeforeCreate(array $data): array
    {
        $data['name'] = ucwords(strtolower(trim($data['name'])));
        $data['description'] = trim($data['description']);
        $data['created_by'] = $data['created_by'] ?? Auth::id();
        return $data;
    }

    protected function prepareDataBeforeUpdate(array $data): array
    {
        $data['name'] = ucwords(strtolower(trim($data['name'])));
        $data['description'] = trim($data['description']);
        return $data;
    }

    public function getAll()
    {
        return Role::with('createdBy:id,name')->orderBy('id', 'asc')->get();
    }

    public function create(array $data)
    {
        return Role::create($this->prepareDataBeforeCreate($data));
    }

    public function update(int $id, array $data)
    {
        $role = $this->getRoleById($id);
        $role->update($this->prepareDataBeforeUpdate($data));
        return $role;
    }

    public function delete(int $id)
    {
        return $this->getRoleById($id)->delete();
    }

    public function getRoleById(int $id): Role
    {
        return $this->roleCache[$id] ??= Role::with('createdBy:id,name')->findOrFail($id);
    }
}
