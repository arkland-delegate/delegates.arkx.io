<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Delegate;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_cannot_search_disbursements()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->post('/dashboard/lost-and-found/search', ['search' => 'fake-address'])
            ->assertStatus(403);
    }

    /** @test */
    public function delegates_can_search_disbursements()
    {
        $delegates = factory(Delegate::class)->create(['verified_at' => null]);

        $this
            ->actingAs($this->createDelegate())
            ->post('/dashboard/lost-and-found/search', ['search' => $delegates->first()->address])
            ->assertSuccessful()
            ->assertSee($delegates->first()->address);
    }

    /** @test */
    public function guests_cannot_search_disbursements()
    {
        $this
            ->post('/dashboard/lost-and-found/search', ['search' => 'fake-address'])
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
