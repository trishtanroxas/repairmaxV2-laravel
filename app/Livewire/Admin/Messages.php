<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Message;
use App\Models\User;
use App\Models\Notification;

#[Layout('components.layouts.admin')]
#[Title('Messages | Repairmax')]
class Messages extends Component
{
    use WithPagination;

    public $selectedMessage = null;
    public $replyMessage = '';
    public $searchTerm = '';
    public $lastMessageId;

    public function mount()
    {
        $this->lastMessageId = Message::max('id') ?? 0;
    }

    public function checkForNewMessages()
    {
        $newMessages = Message::with('user')
            ->where('id', '>', $this->lastMessageId)
            ->where(function ($query) {
                $query->whereNull('admin_id')
                    ->orWhere('admin_id', auth()->id());
            })
            ->get();

        if ($newMessages->isNotEmpty()) {
            foreach ($newMessages as $message) {
                $userName = $message->user ? ($message->user->first_name . ' ' . $message->user->last_name) : 'A user';
                if (str_contains(strtolower($message->subject), 'switch to live support') || str_contains(strtolower($message->message), 'requested live support')) {
                    $this->dispatch('toast', message: "{$userName} has switched to live support!", type: 'info');
                } else {
                    $this->dispatch('toast', message: "New message from {$userName}: {$message->subject}", type: 'info');
                }
            }
            $this->lastMessageId = $newMessages->max('id');
            $this->dispatch('$refresh');
        }
    }

    public function getMessages()
    {
        return Message::with('user')
            ->where(function ($query) {
                $query->whereNull('admin_id')
                    ->orWhere('admin_id', auth()->id());
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('subject', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('message', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                    });
            })
            ->orderBy('admin_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function selectMessage($messageId)
    {
        $this->selectedMessage = Message::find($messageId);
        if ($this->selectedMessage && !$this->selectedMessage->admin_read) {
            $this->selectedMessage->update([
                'admin_read' => true,
                'admin_read_at' => now(),
            ]);
        }
    }

    public function closeMessage()
    {
        $this->selectedMessage = null;
        $this->replyMessage = '';
    }

    public function sendReply()
    {
        if (!$this->selectedMessage || empty(trim($this->replyMessage))) {
            return;
        }

        // Create a new message for the reply
        $reply = Message::create([
            'user_id' => $this->selectedMessage->user_id,
            'admin_id' => auth()->id(),
            'subject' => 'Re: ' . $this->selectedMessage->subject,
            'message' => $this->replyMessage,
            'admin_read' => true,
            'admin_read_at' => now(),
        ]);

        // Notify the user that admin replied
        $adminName = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        Notification::create([
            'user_id' => $this->selectedMessage->user_id,
            'title' => 'Admin Reply to Support Message',
            'message' => $adminName . ' replied to your support message: ' . substr($this->replyMessage, 0, 50) . '...',
            'type' => 'message_reply',
            'related_model' => 'Message',
            'related_id' => $reply->id,
            'is_read' => false,
        ]);

        $this->replyMessage = '';
        $this->dispatch('messageAdded');
    }

    public function deleteMessage($messageId)
    {
        Message::find($messageId)?->delete();
        if ($this->selectedMessage?->id === $messageId) {
            $this->closeMessage();
        }
    }

    public function render()
    {
        return view('livewire.admin.messages', [
            'messages' => $this->getMessages(),
        ]);
    }
}

