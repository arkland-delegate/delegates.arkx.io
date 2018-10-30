<?php

namespace App\Providers;

use App\Events\BlockWasMissed;
use App\Events\RankWasShifted;
use App\Events\StatusWasCreated;
use App\Events\VoteWasShifted;
use App\Listeners\SendMissedBlockNotification;
use App\Listeners\SendNewStatusNotification;
use App\Listeners\SendRankShiftNotification;
use App\Listeners\SendVoteShiftNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BlockWasMissed::class   => [
            SendMissedBlockNotification::class,
        ],
        RankWasShifted::class   => [
            SendRankShiftNotification::class,
        ],
        StatusWasCreated::class => [
            SendNewStatusNotification::class,
        ],
        VoteWasShifted::class   => [
            SendVoteShiftNotification::class,
        ],
    ];
}
