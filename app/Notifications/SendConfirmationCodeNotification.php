<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Helpers\NotificationChannelHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendConfirmationCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /** Create a new notification instance. */
    public function __construct(private readonly int $code) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return NotificationChannelHelper::getNotificationChannels(get_class($this));
    }

    /** Get the mail representation of the notification. */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'SendConfirmationCodeNotification',
            'code'  => $this->code,
        ];
    }
}
