<?php

namespace App\Notifications;

use App\Models\Delegate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DelegateVerified extends Notification
{
    use Queueable;

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
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "Your delegate {$this->delegate->username} has been verified.",
        ];
    }
}
