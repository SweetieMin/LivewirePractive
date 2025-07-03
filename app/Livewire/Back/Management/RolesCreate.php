<?php

namespace App\Livewire\Back\Management;

use Livewire\Component;

class RolesCreate extends Component
{
    public $hasChanges = false;
    public $name, $description;
    

    public function render()
    {
        return view('livewire.back.management.roles-create');
    }
}
