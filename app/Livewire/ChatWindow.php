<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Portal;
use App\Models\User;
use App\Notifications\NewMessage;
use App\Services\ChatService;
use App\Services\FileStorageService;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChatWindow extends Component
{
    private ChatService $chatService;

    public ?Conversation $conversation = null;

    public $otherUsers = [];

    public ?Portal $portal = null;

    public Collection $messages;

    public string $input;

    private FileStorageService $fileStorageService;

    protected $listeners = [
        'conversationSelected' => 'loadConversation',
    ];

    public function boot(ChatService $chatService): void
    {
        $this->chatService = $chatService;
        $this->fileStorageService = new FileStorageService();
    }

    public function mount(): void
    {
        $this->messages = collect();

        if ($this->conversation) {
            $this->loadConversation($this->conversation);
        }
    }

    public function loadConversation(Conversation $conversation): void
    {
        $this->conversation = $conversation;

        $this->otherUsers = $this->conversation->otherUsers();

        $this->portal = auth()->user()->portal;
        $this->messages = $this->chatService->getMessages($this->conversation);
    }

    public function render()
    {
        return view('livewire.chat-window');
    }

    public function newMessage(): void
    {
        $sender = auth()->user();

        $message = Message::query()->create([
            'sender_id' => $sender->id,
            'conversation_id' => $this->conversation->id,
            'message' => $this->input,
        ]);

        $this->conversation->users()
            ->whereKeyNot($sender->id)
            ->get()
            ->each(fn ($user) => $user->notify(new NewMessage($sender, $this->conversation, $message)));

        $this->loadConversation($this->conversation);

        $this->input = '';
    }

    public function getUserProfilePicture(User $user): string
    {
        return $this->fileStorageService->userProfilePicture($user);
    }
}
