<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Repair;
use App\Models\Appointment;
use App\Models\User;
use App\Models\InventoryItem;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Reports | Repairmax')]
class Reports extends Component
{
    public $reportType = 'summary';
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function render()
    {
        $repairStats = [
            'total' => Repair::count(),
            'pending' => Repair::where('status', 'Pending')->count(),
            'in_progress' => Repair::where('status', 'In Progress')->count(),
            'completed' => Repair::where('status', 'Completed')->count(),
        ];

        $appointmentStats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'scheduled' => Appointment::where('status', 'scheduled')->count(),
            'completed' => Appointment::where('status', 'completed')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
        ];

        $userStats = [
            'total_users' => User::where('role', 'user')->count(),
            'active_users' => User::where('role', 'user')->where('is_active', true)->count(),
            'total_admins' => User::where('role', 'admin')->count(),
        ];

        $inventoryStats = [
            'total_items' => InventoryItem::count(),
            'low_stock' => InventoryItem::where('quantity', '<=', 10)->count(),
            'out_of_stock' => InventoryItem::where('quantity', '<=', 0)->count(),
            'total_value' => InventoryItem::sum(\DB::raw('quantity * unit_price')),
        ];

        $recentRepairs = Repair::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentAppointments = Appointment::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.admin.reports', array_merge(compact(
            'repairStats',
            'appointmentStats',
            'userStats',
            'inventoryStats',
            'recentRepairs',
            'recentAppointments'
        ), [
            'metrics' => $this->getMetrics()
        ]));
    }

    public function getRevenueTrend()
    {
        $days = [];
        $revenue = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $days[] = Carbon::parse($date)->format('M d');

            // Calculate daily revenue (estimated from appointments)
            $dayRevenue = Appointment::whereDate('created_at', $date)
                ->where('status', 'Completed')
                ->count() * 50; // Assume $50 per repair

            $revenue[] = $dayRevenue;
        }

        return [
            'labels' => $days,
            'data' => $revenue,
        ];
    }

    public function getRepairStatusDistribution()
    {
        $pending = Appointment::where('status', 'Pending')->count();
        $inProgress = Appointment::where('status', 'In Progress')->count();
        $completed = Appointment::where('status', 'Completed')->count();
        $cancelled = Appointment::where('status', 'Cancelled')->count();

        return [
            'labels' => ['Pending', 'In Progress', 'Completed', 'Cancelled'],
            'data' => [$pending, $inProgress, $completed, $cancelled],
            'backgroundColor' => ['#FBBF24', '#3B82F6', '#10B981', '#EF4444'],
        ];
    }

    public function getServiceTypeTrends()
    {
        $days = [];
        $phones = [];
        $laptops = [];
        $tablets = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $days[] = Carbon::parse($date)->format('M d');

            $phones[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Phone%')
                      ->orWhere('device_brand', 'like', '%Phone%')
                      ->orWhere('device_model', 'like', '%iPhone%');
                })->count();

            $laptops[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Laptop%')
                      ->orWhere('device_brand', 'like', '%Laptop%')
                      ->orWhere('device_model', 'like', '%MacBook%');
                })->count();

            $tablets[] = Appointment::whereDate('created_at', $date)
                ->where(function($q) {
                    $q->where('device_model', 'like', '%Tablet%')
                      ->orWhere('device_brand', 'like', '%Tablet%')
                      ->orWhere('device_model', 'like', '%iPad%');
                })->count();
        }

        return [
            'labels' => $days,
            'phones' => $phones,
            'laptops' => $laptops,
            'tablets' => $tablets,
        ];
    }

    public function getAverageRepairTime()
    {
        // Calculate average based on appointment duration
        $appointments = Appointment::where('status', 'Completed')
            ->whereNotNull('completed_at')
            ->get();

        if ($appointments->isEmpty()) {
            return 0;
        }

        $totalTime = 0;
        foreach ($appointments as $appointment) {
            $created = $appointment->created_at;
            $completed = $appointment->completed_at ?? now();
            $hours = $created->diffInHours($completed);
            $totalTime += $hours;
        }

        return round($totalTime / count($appointments), 1);
    }

    public function getMetrics()
    {
        return [
            'avgRepairTime' => $this->getAverageRepairTime(),
            'satisfaction' => 96,
            'repeatCustomers' => User::count() > 0 ? round((User::where('created_at', '<', Carbon::now()->subMonths(3))->count() / User::count() * 100), 1) : 0,
            'warrantyRate' => 2.1,
            'revenueTrend' => $this->getRevenueTrend(),
            'statusDistribution' => $this->getRepairStatusDistribution(),
            'serviceTrends' => $this->getServiceTypeTrends(),
        ];
    }

    public function exportReport()
    {
        try {
            $fileName = 'repair-report-' . date('Y-m-d-His') . '.csv';
            
            // Get data
            $repairs = Repair::with('user')
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();

            // Create CSV content
            $csv = "Repair Report\n";
            $csv .= "Generated: " . now()->format('Y-m-d H:i:s') . "\n";
            $csv .= "Period: {$this->startDate} to {$this->endDate}\n\n";
            
            $csv .= "Tracking Code,Customer,Device,Issue Type,Status,Quote,Created Date\n";

            foreach($repairs as $repair) {
                $csv .= "\"{$repair->tracking_code}\",";
                $csv .= "\"{$repair->user->getFullName()}\",";
                $csv .= "\"{$repair->device_name}\",";
                $csv .= "\"{$repair->issue_type}\",";
                $csv .= "\"{$repair->status}\",";
                $csv .= "\"₱{$repair->quote}\",";
                $csv .= "\"{$repair->created_at->format('Y-m-d')}\"\n";
            }

            // Create temporary file
            $path = storage_path('app/temp/' . $fileName);
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            file_put_contents($path, $csv);

            // Download and delete
            session()->flash('success', 'Report exported successfully!');
            
            return response()->download($path)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to export report: ' . $e->getMessage());
        }
    }

    public function exportAppointmentReport()
    {
        try {
            $fileName = 'appointment-report-' . date('Y-m-d-His') . '.csv';
            
            $appointments = Appointment::with('user')
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();

            $csv = "Appointment Report\n";
            $csv .= "Generated: " . now()->format('Y-m-d H:i:s') . "\n";
            $csv .= "Period: {$this->startDate} to {$this->endDate}\n\n";
            
            $csv .= "Tracking Code,Customer,Device,Fault Category,Preferred Date,Status,Created Date\n";

            foreach($appointments as $appointment) {
                $csv .= "\"{$appointment->tracking_code}\",";
                $csv .= "\"{$appointment->user->getFullName()}\",";
                $csv .= "\"{$appointment->device_brand} {$appointment->device_model}\",";
                $csv .= "\"{$appointment->fault_category}\",";
                $csv .= "\"{$appointment->pref_date}\",";
                $csv .= "\"{$appointment->status}\",";
                $csv .= "\"{$appointment->created_at->format('Y-m-d')}\"\n";
            }

            $path = storage_path('app/temp/' . $fileName);
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            file_put_contents($path, $csv);
            
            session()->flash('success', 'Appointment report exported successfully!');
            
            return response()->download($path)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to export report: ' . $e->getMessage());
        }
    }
}
