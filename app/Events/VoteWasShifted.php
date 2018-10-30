<?php

namespace App\Events;

use App\Models\Delegate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteWasShifted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The delegate in question.
     *
     * @var \App\Models\Delegate
     */
    public $delegate;

    /**
     * Create a new event instance.
     */
    public function __construct(Delegate $delegate)
    {
        $this->delegate = $delegate;
    }
}
