<?php

namespace Tests\Feature\Http\Auth;

use Tests\TestCase;

/**
 * @coversNothing
 */
class StopImpersonateTest extends TestCase
{
    /** @test */
    public function administrators_can_stop_to_impersonate_users()
    {
        $admin = $this->createAdministrator();

        $this
            ->actingAs($this->createDelegate())
            ->withSession(['arkx:impersonator' => $admin->id])
            ->get('/auth/impersonation/stop')
            ->assertRedirect('/')
            ->assertSessionMissing('arkx:impersonator');
    }
}
