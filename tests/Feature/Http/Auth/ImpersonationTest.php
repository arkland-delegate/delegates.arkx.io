<?php

namespace Tests\Feature\Http\Auth;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ImpersonationTest extends TestCase
{
    /** @test */
    public function administrators_can_impersonate_users()
    {
        $user = $this->createDelegate();

        $this
            ->actingAs($admin = $this->createAdministrator())
            ->get("/auth/impersonation/{$user->id}")
            ->assertRedirect('/dashboard')
            ->assertSessionHas('arkx:impersonator', $admin->id);
    }

    /** @test */
    public function delegates_cannot_impersonate_users()
    {
        $user = $this->createDelegate();

        $this
            ->actingAs($this->createDelegate())
            ->get("/auth/impersonation/{$user->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_impersonate_users()
    {
        $user = $this->createDelegate();

        $this
            ->get("/auth/impersonation/{$user->id}")
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
