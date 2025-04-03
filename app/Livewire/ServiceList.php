<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Service;


class ServiceList extends Component
{

    public $search = '';
    public $perPage = 10;

    public $showAddModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $name = '';
    public $unit = '';
    public $price_per_unit = '';
    public $type = '';

    public $editingServiceId;

    use WithPagination;

    public function render()
    {
        $services = Service::where('name', 'like', "%{$this->search}%")->paginate($this->perPage);
        return view('livewire.service.list', [
            'services' => $services
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function openEditModal($id)
    {
        $this->showEditModal = true;
        $this->editingServiceId = $id;
    }

    public function openDeleteModal($id)
    {
        $this->showDeleteModal = true;
        $this->editingServiceId = $id;
    }

    public function closeModal()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->editingServiceId = null;
    }

    public function createService()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:services,name',
                'unit' => 'required|string|max:255',
                'price_per_unit' => 'required|numeric',
                'type' => 'required|string|in:metered,fixed',
            ]);

            Service::create([
                'name' => $this->name,
                'unit' => $this->unit,
                'price_per_unit' => $this->price_per_unit,
                'type' => $this->type,
            ]);

            $this->closeModal();
            session()->flash('success', 'Dịch vụ đã được tạo thành công');
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateService()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:services,name',
                'unit' => 'required|string|max:255',
                'price_per_unit' => 'required|numeric',
                'type' => 'required|string|in:metered,fixed',
            ]);

            Service::where('id', $this->editingServiceId)->update([
                'name' => $this->name,
                'unit' => $this->unit,
                'price_per_unit' => $this->price_per_unit,
                'type' => $this->type,
            ]);

            $this->closeModal();
            session()->flash('success', 'Dịch vụ đã được cập nhật thành công');
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
    }

    public function deleteService()
    {
        try{
            Service::where('id', $this->editingServiceId)->delete();
            $this->closeModal();
            session()->flash('success', 'Dịch vụ đã được xóa thành công');
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
    }
    
}
