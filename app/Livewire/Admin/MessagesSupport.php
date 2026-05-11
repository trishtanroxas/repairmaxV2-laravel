<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Message;

#[Layout('components.layouts.admin')]
#[Title('Support Tickets | Repairmax')]
class MessagesSupport extends Component
{
    public ?Message $selectedMessage = null;

    public function viewMessage(int|string $id)
    {
        $this->selectedMessage = Message::with('user')->find($id);
        
        if ($this->selectedMessage && !$this->selectedMessage->admin_read) {
            $this->selectedMessage->update([
                'admin_read' => true,
                'admin_read_at' => now(),
            ]);
        }

        $this->dispatch('open-modal', 'view-message');
    }

    public function render()
    {
        return view('livewire.admin.messages-support', [
            'tickets' => Message::with('user')->latest()->get()
        ]);
    }
}
