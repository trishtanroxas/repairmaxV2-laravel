<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Repair;

#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard | Repairmax')]
class Dashboard extends Component
{
    public $totalUsers = 0;
    public $totalAppointments = 0;
    public $monthlyRevenue = 0;
    public $systemHealth = 99.8;
    public $recentAppointments = [];
    public $newRegistrations = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load real data from database
        $this->totalUsers = User::where('role', 'user')->where('is_active', true)->count();
        $this->totalAppointments = Appointment::count();
        $this->recentAppointments = Appointment::with('user')
            ->latest()
            ->limit(5)
            ->get();
        $this->newRegistrations = User::where('role', 'user')
            ->latest()
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
