<?php

namespace Tests\Feature\Notifications;

use App\Models\Delegate;
use App\Models\User;
use App\Notifications\VoteShifted;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class VoteShiftedTest extends TestCase
{
    /** @test */
    public function it_should_notify_the_user()
    {
        Notification::fake();

        $delegate = factory(Delegate::class)->create();

        $user = factory(User::class)->create();
        $user->notify(new VoteShifted($delegate));

        Notification::assertSentTo(
            $user,
            VoteShifted::class,
            function ($notification, $channels) use ($delegate) {
                return $notification->delegate->id === $delegate->id;
            }
        );
    }
}
