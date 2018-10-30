<?php

namespace App\Notifications;

use App\Models\Delegate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoteShifted extends Notification
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
            ->line('Attention! The winds of change are blowing, and ARK votes for '.$this->delegate->username.' have shifted. Please follow the link to see how your payout might be affected.')
            ->action('View Delegate', route('delegate', $this->delegate))
            ->line('Thank you for your continued support and happy stacking!');
    }
}
