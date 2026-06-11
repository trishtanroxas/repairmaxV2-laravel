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
    public $lastMessageId;

    public function mount()
    {
        $this->lastMessageId = Message::max('id') ?? 0;
    }

    public function checkForNewMessages()
    {
        $newMessages = Message::with('user')
            ->where('id', '>', $this->lastMessageId)
            ->get();

        if ($newMessages->isNotEmpty()) {
            foreach ($newMessages as $message) {
                $userName = $message->user ? ($message->user->first_name . ' ' . $message->user->last_name) : 'A user';
                if (str_contains(strtolower($message->subject), 'switch to live support') || str_contains(strtolower($message->message), 'requested live support')) {
                    $this->dispatch('toast', message: "{$userName} has switched to live support!", type: 'info');
                } else {
                    $this->dispatch('toast', message: "New support ticket from {$userName}: {$message->subject}", type: 'info');
                }
            }
            $this->lastMessageId = $newMessages->max('id');
            $this->dispatch('$refresh');
        }
    }

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
