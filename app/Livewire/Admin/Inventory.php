<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\InventoryItem;
use App\Models\Brand;
use App\Models\FaultType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

#[Layout('components.layouts.admin')]
#[Title('Inventory | Repairmax')]
class Inventory extends Component
{
    use WithPagination;
    public $search = '';
    public $sortOrder = 'latest'; // 'latest', 'alpha_asc', 'alpha_desc', 'stock_asc', 'stock_desc'
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    // Modal & Form State
    public $showEditModal = false;
    public ?int $editingId = null;
    
    public $showDeleteModal = false;
    public ?int $deletingId = null;
    public $deletingName = '';
    
    // Form Fields
    public $formName = '';
    public $formSku = '';
    public $formQuantity = 0;
    public $formUnitPrice = 0;
    public ?int $formBrandId = null;

    protected function rules()
    {
        return [
            'formName' => 'required|string|max:255',
            'formBrandId' => 'nullable|exists:brands,id',
            'formSku' => 'required|string|max:100|unique:inventory_items,sku,' . $this->editingId,
            'formQuantity' => 'required|integer|min:0',
            'formUnitPrice' => 'required|numeric|min:0',
        ];
    }

    public function editRecord(?int $id = null)
    {
        $this->resetForm();
        $this->editingId = $id ?: null;
        
        if ($this->editingId) {
            $record = InventoryItem::findOrFail($id);
            $this->formName = $record->name;
            $this->formBrandId = $record->brand_id;
            $this->formSku = $record->sku;
            $this->formQuantity = $record->quantity;
            $this->formUnitPrice = $record->unit_price;
        }
        
        $this->showEditModal = true;
    }

    public function saveRecord()
    {
        $this->validate();

        InventoryItem::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->formName,
            'brand_id' => $this->formBrandId,
            'sku' => $this->formSku,
            'quantity' => $this->formQuantity,
            'unit_price' => $this->formUnitPrice,
        ]);

        $this->showEditModal = false;
        $this->resetForm();
        Session::flash('message', 'Inventory item saved successfully.');
    }

    public function confirmDelete(int $id)
    {
        $this->deletingId = $id;
        $this->deletingName = InventoryItem::find($id)?->name ?? '';
        $this->showDeleteModal = true;
    }

    public function deleteRecord()
    {
        if ($this->deletingId) {
            InventoryItem::findOrFail($this->deletingId)->delete();
            Session::flash('message', 'Inventory item deleted successfully.');
        }

        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->deletingName = '';
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->formName = '';
        $this->formBrandId = null;
        $this->formSku = '';
        $this->formQuantity = 0;
        $this->formUnitPrice = 0;
    }

    public function render()
    {
        $brands = Brand::orderBy('name')->get();
        $query = InventoryItem::with('brand');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('sku', 'like', '%' . $this->search . '%');
        }

        // Apply Sorting
        if ($this->sortOrder === 'alpha_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sortOrder === 'alpha_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sortOrder === 'stock_asc') {
            $query->orderBy('quantity', 'asc');
        } elseif ($this->sortOrder === 'stock_desc') {
            $query->orderBy('quantity', 'desc');
        } else {
            $query->latest();
        }

        $records = $query->simplePaginate(10);

        return view('livewire.admin.inventory', [
            'records' => $records,
            'brands' => $brands,
            'totalItems' => InventoryItem::count(),
            'lowStock' => InventoryItem::where('quantity', '<=', 10)->count(),
            'totalValue' => InventoryItem::sum(DB::raw('quantity * unit_price')),
        ]);
    }
}
