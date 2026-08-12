<?php

namespace App\Notifications;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification
{
    use Queueable;

    public function __construct(
        public User $sender,
        public Conversation $conversation,
        public Message $message,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New message from '.$this->sender->name)
            ->line($this->notificationMessage())
            ->action('View Chat', $this->chatUrl($notifiable))
            ->line('Thank you for using Portal Ease!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->notificationMessage(),
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'conversation_id' => $this->conversation->id,
            'message_id' => $this->message->id,
            'action_url' => $this->chatUrl($notifiable),
        ];
    }

    private function notificationMessage(): string
    {
        return "You have a new message from {$this->sender->name}.";
    }

    private function chatUrl(object $notifiable): string
    {
        return route('portal.user.chat', [
            'portal' => $notifiable->portal,
            'user' => $notifiable,
        ]);
    }
}
