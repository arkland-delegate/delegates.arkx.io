<?php

namespace Tests\Feature\Http\Dashboard\Notifications;

use App\Models\Delegate;
use App\Notifications\NewStatus;
use Tests\TestCase;

/**
 * @coversNothing
 */
class AllTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_all_notifications()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/notifications/all')
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_view_all_notifications()
    {
        factory(Delegate::class)->create();

        $user = $this->createDelegate();
        $user->notify(new NewStatus($this->createStatus()));

        $this
            ->actingAs($user)
            ->get('/dashboard/notifications/all')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_all_notifications()
    {
        $this
            ->get('/dashboard/notifications/all')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
