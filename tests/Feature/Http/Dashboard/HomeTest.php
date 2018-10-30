<?php

namespace Tests\Feature\Http\Dashboard;

use Tests\TestCase;

/**
 * @coversNothing
 */
class HomeTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_dashboard()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard')
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_view_the_dashboard()
    {
        $this
            ->actingAs($this->createDelegate())
            ->get('/dashboard')
            ->assertRedirect('/dashboard/delegates');
    }

    /** @test */
    public function guests_cannot_view_the_dashboard()
    {
        $this
            ->get('/dashboard')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
