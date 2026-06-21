<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Portal;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChatWindow extends Component
{
    public ?Conversation $conversation = null;
    public $otherUsers = [];
    public ?Portal $portal = null;

    public Collection $messages;

    public string $input;

    protected $listeners = [
        'conversationSelected' => 'loadConversation'
    ];

    public function mount(): void
    {
        $this->messages = collect();

        if ($this->conversation) {
            $this->loadUsers();

            $this->messages = $this->conversation->messages()->get()->sortByDesc('created_at');
        }
    }

    protected function loadUsers(): void
    {
        $this->otherUsers = $this->conversation
            ->users()
            ->where('users.id', '!=', auth()->id())
            ->get();

        $this->portal = $this->otherUsers->first()?->portal;
    }

    public function loadConversation($conversationId): void
    {
        $this->conversation = Conversation::find($conversationId);

        if ($this->conversation) {
            $this->loadUsers();
            $this->messages = $this->conversation->messages()->get();
        }else{
            $this->messages = collect();
        }
    }

    public function render()
    {
        return view('livewire.chat-window');
    }

    public function newMessage(): void
    {
         Message::query()->create([
            'sender_id' => auth()->id(),
            'conversation_id' => $this->conversation->id,
            'message' => $this->input,
        ]);

        $this->messages = $this->conversation
            ->messages()
            ->latest()
            ->get();

        $this->input = '';
    }
}
