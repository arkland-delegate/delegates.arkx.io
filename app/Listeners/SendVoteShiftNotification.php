<?php

namespace App\Listeners;

use App\Events\VoteWasShifted;
use App\Notifications\VoteShifted;

class SendVoteShiftNotification
{
    /**
     * Handle the event.
     *
     * @param VoteWasShifted $event
     *
     * @return void
     */
    public function handle(VoteWasShifted $event)
    {
        $subscribers = $event->delegate->subscribers;

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new VoteShifted($event->delegate));
        }
    }
}
