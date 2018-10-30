<?php

namespace App\Notifications;

use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStatus extends Notification
{
    use Queueable;

    /**
     * The status in question.
     *
     * @var \App\Models\Status
     */
    public $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line('Status Update by '.$this->status->delegate->username)
            ->action('View Status', route('delegate.status', [$this->status->delegate, $this->status]))
            ->line('Thank you for your continued support and happy stacking!');
    }
}
