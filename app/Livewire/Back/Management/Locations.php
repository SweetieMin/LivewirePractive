<?php

namespace App\Livewire\Back\Management;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\LocationRepositoryInterface;

class Locations extends Component
{
    use WithPagination;
    
    public function render()
    {
        $locations = app(LocationRepositoryInterface::class)->getAll(10);
        return view('livewire.back.management.locations',[
            'locations' => $locations,
        ]);
    }
}
