<?php

namespace App\Notifications;

use App\Models\Delegate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BlockMissed extends Notification
{
    use Queueable;

    /**
     * The delegate in question.
     *
     * @var \App\Models\Delegate
     */
    public $delegate;

    /**
     * Create a new notification instance.
     */
    public function __construct(Delegate $delegate)
    {
        $this->delegate = $delegate;
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
            ->line('All hands on deck! Our sources indicate '.$this->delegate->username.' is currently not forging. Follow the link for more details.')
            ->action('View Delegate', route('delegate', $this->delegate))
            ->line('Thank you for your continued support and happy stacking!');
    }
}
