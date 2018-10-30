<?php

namespace Tests\Feature\Notifications;

use App\Models\Delegate;
use App\Models\User;
use App\Notifications\BlockMissed;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class BlockMissedTest extends TestCase
{
    /** @test */
    public function it_should_notify_the_user()
    {
        Notification::fake();

        $delegate = factory(Delegate::class)->create();

        $user = factory(User::class)->create();
        $user->notify(new BlockMissed($delegate));

        Notification::assertSentTo(
            $user,
            BlockMissed::class,
            function ($notification, $channels) use ($delegate) {
                return $notification->delegate->id === $delegate->id;
            }
        );
    }
}
