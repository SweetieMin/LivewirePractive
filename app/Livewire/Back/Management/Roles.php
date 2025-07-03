<?php

namespace App\Livewire\Back\Management;
use App\Repositories\Contracts\RoleRepositoryInterface;

use Livewire\Component;

class Roles extends Component
{
    public $hasChanges = false;
    public function render()
    {
        $roles = app(RoleRepositoryInterface::class)->getAll();
        return view('livewire.back.management.roles',[
            'roles' => $roles
        ])->layout('components.layouts.app', [
            'title' => 'Roles',
        ]);
    }
}
