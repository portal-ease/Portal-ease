<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivateAccount extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $token,
        private readonly object $portal,
    ) {}

    /**
     * Create a new notification instance.
     */
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Activate your '.config('app.name').' account')
            ->greeting('You have been invited to '.($this->portal->name ?? config('app.name')).'.')
            ->line('Set your password to activate your account and access the portal.')
            ->action('Activate account', route('activation.create', [
                'portal' => $this->portal,
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]))
            ->line('This activation link will expire in 60 minutes.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
