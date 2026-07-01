<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Portal;
use App\Models\User;
use App\Services\ChatService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ChatSidebar extends Component
{
    public Collection $conversations;

    public Portal $portal;

    public function render(): View
    {
        return view('livewire.chat-sidebar');
    }

    public function conversationSelected(Conversation $conversation): void
    {
        $this->dispatch('conversationSelected', conversation: $conversation);
    }
}
