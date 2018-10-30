<?php

namespace App\Listeners;

use App\Events\StatusWasCreated;
use App\Notifications\NewStatus;

class SendNewStatusNotification
{
    /**
     * Handle the event.
     *
     * @param StatusWasCreated $event
     *
     * @return void
     */
    public function handle(StatusWasCreated $event)
    {
        $subscribers = $event->status->delegate->subscribers;

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new NewStatus($event->status));
        }
    }
}
