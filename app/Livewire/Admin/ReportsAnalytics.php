<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Analytics | Repairmax')]
class ReportsAnalytics extends Component
{
    public function render()
    {
        return view('livewire.admin.reports-analytics');
    }
}
