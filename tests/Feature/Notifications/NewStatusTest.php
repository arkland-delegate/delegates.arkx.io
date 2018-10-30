<?php

namespace Tests\Feature\Notifications;

use App\Models\Status;
use App\Models\User;
use App\Notifications\NewStatus;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class NewStatusTest extends TestCase
{
    /** @test */
    public function it_should_notify_the_user()
    {
        Notification::fake();

        $status = factory(Status::class)->create();

        $user = factory(User::class)->create();
        $user->notify(new NewStatus($status));

        Notification::assertSentTo(
            $user,
            NewStatus::class,
            function ($notification, $channels) use ($status) {
                return $notification->status->id === $status->id;
            }
        );
    }
}
