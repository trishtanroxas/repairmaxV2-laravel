<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment as AppointmentModel;

#[Layout('components.layouts.admin')]
#[Title('Appointments | Repairmax')]
class Appointment extends Component
{
    public $search = '';
    public $selectedAppointment = null;
    public $showViewModal = false;

    public function render()
    {
        $appointments = AppointmentModel::with('user')
            ->when($this->search, function ($query) {
                $query->where('device_brand', 'like', '%'.$this->search.'%')
                    ->orWhere('device_model', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('first_name', 'like', '%'.$this->search.'%')
                            ->orWhere('last_name', 'like', '%'.$this->search.'%');
                    });
            })
            ->orderBy('pref_date', 'desc')
            ->paginate(10);

        return view('livewire.admin.appointment', compact('appointments'));
    }

    public function viewAppointment($id)
    {
        $this->selectedAppointment = AppointmentModel::with('user')->findOrFail($id);
        $this->showViewModal = true;
    }

    public function closeModal()
    {
        $this->showViewModal = false;
        $this->selectedAppointment = null;
    }

    public function updateStatus($appointmentId, $newStatus)
    {
        $appointment = AppointmentModel::findOrFail($appointmentId);
        $appointment->update(['status' => $newStatus]);
        
        // Send notification to user
        \App\Models\Notification::create([
            'user_id' => $appointment->user_id,
            'admin_id' => auth()->id(),
            'title' => 'Appointment Status Updated',
            'message' => "Your appointment status has been updated to: {$newStatus}",
            'type' => 'appointment_confirmation',
            'related_model' => 'Appointment',
            'related_id' => $appointment->id,
        ]);

        session()->flash('message', 'Appointment status updated successfully!');
        
        if($this->showViewModal && $this->selectedAppointment->id === $appointmentId) {
            $this->viewAppointment($appointmentId);
        }
    }
}
