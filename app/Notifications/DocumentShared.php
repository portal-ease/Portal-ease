<?php

namespace App\Notifications;

use App\Models\File;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentShared extends Notification
{
    use Queueable;

    public function __construct(
        public readonly User $user,
        public readonly File $file
    ){}

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
            ->subject('New document shared to you!')
            ->line($this->notificationMessage())
            ->action('View document', $this->chatUrl($notifiable))
            ->line('Thank you for using Portal Ease!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->notificationMessage(),
        ];
    }

    private function notificationMessage(): string
    {
        return "{$this->user->name} shared document {$this->file->filename} with you!";
    }

    private function chatUrl(object $notifiable): string
    {
        return route('portal.file.index', [
            'portal' => $notifiable->portal,
        ]);
    }
}
