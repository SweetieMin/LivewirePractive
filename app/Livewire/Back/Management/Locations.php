<?php

    namespace App\Livewire\Back\Management;

    use App\Repositories\Contracts\LocationRepositoryInterface;
    use Flux\Flux;
    use Livewire\Component;
    use Livewire\WithPagination;
    use App\Support\Validation\LocationRules;

    class Locations extends Component
    {
        use WithPagination;
        public $name, $address, $locationId;
        public $originalName;
        public $originalAddress;
        public $isUpdateMode = false;
        public $hasChanges = false;

        public function updated()
        {
            if ($this->isUpdateMode) {
                $this->hasChanges =
                    (trim($this->name) !== '' && trim($this->name) !== $this->originalName) ||
                    (trim($this->address) !== '' && trim($this->address) !== $this->originalAddress);
            } else {
                $this->hasChanges =
                    trim($this->name) !== '' &&
                    trim($this->address) !== '';
            }
        }

        protected function rules($id = null)
        {
            return LocationRules::rules($id);
        }

        protected function messages()
        {
            return LocationRules::messages();
        }

        public function add()
        {
            $this->reset('name', 'address', 'hasChanges');
            $this->isUpdateMode = false;
            Flux::modal('modal-location')->show();
        }

        public function create()
        {
            $validated = $this->validate();
            try {
                $location = app(LocationRepositoryInterface::class)->create($validated);
                Flux::modal('modal-location')->close();
                $this->reset('name', 'address', 'hasChanges');
                session()->flash('success', 'Tạo cơ sở mới thành công.');
                $this->redirectRoute('locations', navigate: true);
            } catch (\Exception $e) {
                logger()->error('Lỗi tạo cơ sở: ' . $e->getMessage());
                session()->flash('error', 'Đã xảy ra lỗi khi tạo cơ sở.');
            }
        }

        public function edit($id)
        {
            $this->reset('name', 'address', 'hasChanges');
            $location = app(LocationRepositoryInterface::class)->getLocationById($id);
            if ($location) {
                $this->locationId = $location->id;
                $this->name = $location->name;
                $this->address = $location->address;
            } else {
                session()->flash('error', 'Location not found.');
                return;
            }
            $this->originalName = $this->name;
            $this->originalAddress = $this->address;
            $this->isUpdateMode = true;
            Flux::modal('modal-location')->show();
        }

        public function update()
        {
            $validated = $this->validate($this->rules($this->locationId));
            try {
                $location = app(LocationRepositoryInterface::class)->update($this->locationId, $validated);
                session()->flash('success', 'Cập nhật cơ sở thành công.');
                $this->reset('name', 'address', 'locationId', 'originalName', 'originalAddress');
                Flux::modal('modal-location')->close();
                //$this->redirectRoute('locations', navigate: true);
            } catch (\Exception $e) {
                logger()->error('Error updating location: ' . $e->getMessage());
                session()->flash('error', 'Đã xảy ra lỗi khi cập nhật cơ sở.');
                return;
            }
        }

        public function delete($id)
        {
            $this->locationId = app(LocationRepositoryInterface::class)->getLocationById($id);
            if ($this->locationId) {
                Flux::modal('locations-delete')->show();
            } else {
                session()->flash('error', 'Không tìm thấy cơ sở.');
            }
        }

        public function deleteLocation()
        {
            if ($this->locationId) {
                try {
                    app(LocationRepositoryInterface::class)->delete($this->locationId->id);
                    session()->flash('warning', 'Xóa cơ sở thành công.');
                } catch (\Exception $e) {
                    logger()->error('Lỗi tạo cơ sở: ' . $e->getMessage());
                    session()->flash('error', 'Đã xảy ra lỗi khi xóa cơ sở.');
                }
            } else {
                session()->flash('error', 'Không tìm thấy cơ sở.');
            }
            $this->reset('locationId');
            Flux::modal('locations-delete')->close();
            $this->redirectRoute('locations', navigate: true);
        }

        public function render()
        {
            $locations = app(LocationRepositoryInterface::class)->getAll(10);
            return view('livewire.back.management.locations', [
                'locations' => $locations,
            ])->layout('components.layouts.app', [
                'title' => 'Locations',
            ]);
        }
    }
