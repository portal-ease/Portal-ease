<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Portal;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class ChatSidebar extends Component
{
    public $conversations = [];
    public Portal $portal;
    public Conversation $activeConversation;
    public $selectedUsers = [];
    public string $filledInTitle = "";
    public function mount(User $user)
    {
        $this->conversations = $user->conversations;
        $this->portal = $user->portal;
    }
    public function render()
    {
        return view('livewire.chat-sidebar');
    }
    public function conversationSelected(Conversation $conversation): void
    {
        $this->activeConversation = $conversation;
        $this->dispatch('conversationSelected', $conversation->id);
    }
    public function createConversation(): void
    {
        if (empty($this->selectedUsers)) return;
        $conversation = Conversation::create([
           'type' => 'group' ,
            'title' => $this->filledInTitle,
        ]);
        $conversation->users()->attach(array_merge($this->selectedUsers, [auth()->id()]));
        $this->reset('selectedUsers');
        $this->dispatch('conversationCreated');
    }
}
