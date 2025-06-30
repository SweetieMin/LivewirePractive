<?php

namespace App\Livewire\Back\Management;

use Livewire\Component;
use App\Support\Validation\LocationRules;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Flux\Flux;

class LocationsCreate extends Component
{
    public $name, $address;

    protected function rules()
    {
        return LocationRules::rules();
    }

    protected function messages()
    {
        return LocationRules::messages();
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            $location = app(LocationRepositoryInterface::class)->create($validated);
            $this->reset('name', 'address');
            Flux::modal('locations-create')->close();
            session()->flash('success', 'Tạo cơ sở mới thành công.');
            $this->redirectRoute('locations', navigate: true);

        } catch (\Exception $e) {
            logger()->error('Lỗi tạo cơ sở: ' . $e->getMessage());
            session()->flash('error', 'Đã xảy ra lỗi khi tạo cơ sở.');
        }
    }


    public function render()
    {
        return view('livewire.back.management.locations-create');
    }
}
