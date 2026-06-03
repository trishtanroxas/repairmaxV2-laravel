<?php

namespace App\Livewire\Admin;

use App\Models\SupportedCity;
use Livewire\Component;
use Livewire\WithPagination;

class Cities extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $is_active = true;

    public $editingCityId = null;
    public $isEditMode = false;
    public $confirmingDeletionId = null;

    protected $queryString = ['search'];

    protected $rules = [
        'name' => 'required|string|max:255|unique:supported_cities,name',
        'is_active' => 'boolean',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->is_active = true;
        $this->editingCityId = null;
        $this->isEditMode = false;
        $this->confirmingDeletionId = null;
    }

    public function save()
    {
        if ($this->isEditMode) {
            $this->validate([
                'name' => 'required|string|max:255|unique:supported_cities,name,' . $this->editingCityId,
                'is_active' => 'boolean',
            ]);
            $city = SupportedCity::findOrFail($this->editingCityId);
            $city->update([
                'name' => trim($this->name),
                'is_active' => $this->is_active,
            ]);
            session()->flash('message', 'City updated successfully.');
        } else {
            $this->validate();
            SupportedCity::create([
                'name' => trim($this->name),
                'is_active' => $this->is_active,
            ]);
            session()->flash('message', 'City added successfully.');
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $city = SupportedCity::findOrFail($id);
        $this->editingCityId = $city->id;
        $this->name = $city->name;
        $this->is_active = $city->is_active;
        $this->isEditMode = true;
    }

    public function toggleStatus($id)
    {
        $city = SupportedCity::findOrFail($id);
        $city->is_active = !$city->is_active;
        $city->save();
        session()->flash('message', 'City status updated.');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletionId = $id;
    }

    public function delete()
    {
        if ($this->confirmingDeletionId) {
            SupportedCity::destroy($this->confirmingDeletionId);
            session()->flash('message', 'City removed successfully.');
            $this->resetFields();
        }
    }

    public function cancelDelete()
    {
        $this->confirmingDeletionId = null;
    }

    public function render()
    {
        $cities = SupportedCity::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->simplePaginate(10);

        return view('livewire.admin.cities', compact('cities'))
            ->layout('components.layouts.admin', ['title' => 'Supported Cities']);
    }
}
