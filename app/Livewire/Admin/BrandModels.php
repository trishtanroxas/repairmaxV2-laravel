<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\DeviceModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Brands & Models | Repairmax')]
class BrandModels extends Component
{
    use WithPagination;

    // Brand State
    public $brandSearch = '';
    public $brandName = '';
    public $editingBrandId = null;
    public $showBrandModal = false;
    public $confirmingBrandDeletionId = null;

    // Model State
    public $modelSearch = '';
    public $modelName = '';
    public $modelBrandId = null;
    public $editingModelId = null;
    public $showModelModal = false;
    public $confirmingModelDeletionId = null;
    
    // Filters
    public $filterBrandId = '';

    protected $queryString = [
        'brandSearch' => ['except' => ''],
        'modelSearch' => ['except' => ''],
        'filterBrandId' => ['except' => ''],
    ];

    public function updatingBrandSearch()
    {
        $this->resetPage('brandsPage');
    }

    public function updatingModelSearch()
    {
        $this->resetPage('modelsPage');
    }

    public function updatingFilterBrandId()
    {
        $this->resetPage('modelsPage');
    }

    // Brand Actions
    public function resetBrandFields()
    {
        $this->brandName = '';
        $this->editingBrandId = null;
        $this->showBrandModal = false;
        $this->confirmingBrandDeletionId = null;
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $this->editingBrandId = $brand->id;
        $this->brandName = $brand->name;
        $this->showBrandModal = true;
    }

    public function saveBrand()
    {
        if ($this->editingBrandId) {
            $this->validate([
                'brandName' => 'required|string|max:255|unique:brands,name,' . $this->editingBrandId,
            ]);
            $brand = Brand::findOrFail($this->editingBrandId);
            $brand->update(['name' => trim($this->brandName)]);
            session()->flash('brand_message', 'Brand updated successfully.');
        } else {
            $this->validate([
                'brandName' => 'required|string|max:255|unique:brands,name',
            ]);
            Brand::create(['name' => trim($this->brandName)]);
            session()->flash('brand_message', 'Brand added successfully.');
        }
        $this->resetBrandFields();
    }

    public function confirmDeleteBrand($id)
    {
        $this->confirmingBrandDeletionId = $id;
    }

    public function deleteBrand()
    {
        if ($this->confirmingBrandDeletionId) {
            Brand::destroy($this->confirmingBrandDeletionId);
            session()->flash('brand_message', 'Brand removed successfully.');
            $this->resetBrandFields();
        }
    }

    // Model Actions
    public function resetModelFields()
    {
        $this->modelName = '';
        $this->modelBrandId = null;
        $this->editingModelId = null;
        $this->showModelModal = false;
        $this->confirmingModelDeletionId = null;
    }

    public function editModel($id)
    {
        $model = DeviceModel::findOrFail($id);
        $this->editingModelId = $model->id;
        $this->modelName = $model->name;
        $this->modelBrandId = $model->brand_id;
        $this->showModelModal = true;
    }

    public function saveModel()
    {
        $this->validate([
            'modelName' => 'required|string|max:255',
            'modelBrandId' => 'required|exists:brands,id',
        ]);

        if ($this->editingModelId) {
            $model = DeviceModel::findOrFail($this->editingModelId);
            $model->update([
                'name' => trim($this->modelName),
                'brand_id' => $this->modelBrandId,
            ]);
            session()->flash('model_message', 'Model updated successfully.');
        } else {
            DeviceModel::create([
                'name' => trim($this->modelName),
                'brand_id' => $this->modelBrandId,
            ]);
            session()->flash('model_message', 'Model added successfully.');
        }
        $this->resetModelFields();
    }

    public function confirmDeleteModel($id)
    {
        $this->confirmingModelDeletionId = $id;
    }

    public function deleteModel()
    {
        if ($this->confirmingModelDeletionId) {
            DeviceModel::destroy($this->confirmingModelDeletionId);
            session()->flash('model_message', 'Model removed successfully.');
            $this->resetModelFields();
        }
    }

    public function render()
    {
        $brandsQuery = Brand::query();
        if ($this->brandSearch) {
            $brandsQuery->where('name', 'like', '%' . $this->brandSearch . '%');
        }
        $brands = $brandsQuery->orderBy('name')->simplePaginate(10, ['*'], 'brandsPage');

        $modelsQuery = DeviceModel::with('brand');
        if ($this->modelSearch) {
            $modelsQuery->where('name', 'like', '%' . $this->modelSearch . '%');
        }
        if ($this->filterBrandId) {
            $modelsQuery->where('brand_id', $this->filterBrandId);
        }
        $models = $modelsQuery->latest()->simplePaginate(10, ['*'], 'modelsPage');

        // Retrieve all brands for dropdown selects
        $allBrands = Brand::orderBy('name')->get();

        return view('livewire.admin.brand-models', [
            'brands' => $brands,
            'models' => $models,
            'allBrands' => $allBrands,
        ]);
    }
}
