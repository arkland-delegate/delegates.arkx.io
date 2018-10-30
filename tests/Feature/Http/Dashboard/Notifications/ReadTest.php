<?php

namespace Tests\Feature\Http\Dashboard\Notifications;

use App\Models\Delegate;
use App\Notifications\NewStatus;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ReadTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_read_notifications()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/notifications/read')
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_view_read_notifications()
    {
        factory(Delegate::class)->create();

        $user = $this->createDelegate();
        $user->notify(new NewStatus($this->createStatus()));

        $this
            ->actingAs($user)
            ->get('/dashboard/notifications/read')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_read_notifications()
    {
        $this
            ->get('/dashboard/notifications/read')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
