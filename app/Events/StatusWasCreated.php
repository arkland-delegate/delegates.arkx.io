<?php

namespace App\Events;

use App\Models\Status;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The status in question.
     *
     * @var \App\Models\Status
     */
    public $status;

    /**
     * Create a new event instance.
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }
}
