<?php

namespace Tests\Feature\Http\Dashboard\Delegates;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_delegate_list()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/delegates')
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_view_the_delegate_list()
    {
        $this
            ->actingAs($this->createDelegate())
            ->get('/dashboard/delegates')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_delegate_list()
    {
        $this
            ->get('/dashboard/delegates')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
