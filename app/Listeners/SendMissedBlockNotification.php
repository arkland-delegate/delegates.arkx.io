<?php

namespace App\Listeners;

use App\Events\BlockWasMissed;
use App\Notifications\BlockMissed;

class SendMissedBlockNotification
{
    /**
     * Handle the event.
     *
     * @param BlockWasMissed $event
     *
     * @return void
     */
    public function handle(BlockWasMissed $event)
    {
        $subscribers = $event->delegate->subscribers;

        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new BlockMissed($event->delegate));
        }
    }
}
