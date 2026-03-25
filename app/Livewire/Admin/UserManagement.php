<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('User Management | Repairmax')]
class UserManagement extends Component
{
    use WithPagination;
    
    public $search = '';
    public $filterRole = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getUsers()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('email', 'like', "%{$this->search}%")
                  ->orWhere('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%");
        }

        if ($this->filterRole !== 'all') {
            $query->where('role', $this->filterRole);
        }

        return $query->paginate(10);
    }

    public function blockUser($userId)
    {
        User::find($userId)?->update(['is_active' => false]);
    }

    public function unblockUser($userId)
    {
        User::find($userId)?->update(['is_active' => true]);
    }

    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => $this->getUsers()
        ]);
    }
}
