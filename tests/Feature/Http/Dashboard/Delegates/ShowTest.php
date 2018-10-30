<?php

namespace Tests\Feature\Http\Dashboard\Delegates;

use App\Models\Delegate;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_delegate()
    {
        $delegate = factory(Delegate::class)->create();

        $this
            ->actingAs($this->createAdministrator())
            ->get("/dashboard/delegates/{$delegate->username}")
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_view_the_delegate()
    {
        $this->withoutExceptionHandling();

        $this->createDelegate();

        $delegate = factory(Delegate::class)->create([
            'claimed_at'  => now(),
            'verified_at' => now(),
        ]);

        $this
            ->actingAs($delegate->user)
            ->get("/dashboard/delegates/{$delegate->username}")
            ->assertSuccessful();
    }

    /** @test */
    public function other_delegates_cannot_view_the_delegate()
    {
        $delegate = factory(Delegate::class)->create(['user_id' => 2]);

        $this
            ->actingAs($this->createDelegate())
            ->get("/dashboard/delegates/{$delegate->username}")
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_view_the_delegate()
    {
        $delegate = factory(Delegate::class)->create();

        $this
            ->get("/dashboard/delegates/{$delegate->username}")
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
