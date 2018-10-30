<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Delegate;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ClaimTest extends TestCase
{
    /** @test */
    public function delegates_can_claim_unclaimed_delegates()
    {
        $this->createDelegate();

        $delegate = factory(Delegate::class)->create([
            'user_id'            => 1,
            'verification_token' => null,
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($this->createDelegate())
            ->get("/dashboard/lost-and-found/{$delegate->username}")
            ->assertRedirect("/dashboard/delegates/{$delegate->username}");

        $this->assertNotNull($delegate->fresh()->claimed_at);
        $this->assertNotNull($delegate->fresh()->verification_token);
    }

    /** @test */
    public function delegates_cannot_claim_pending_delegates()
    {
        $delegate = factory(Delegate::class)->create([
            'user_id'            => 2,
            'claimed_at'         => Carbon::now(),
            'verification_token' => str_random(123),
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($this->createDelegate())
            ->from('dashboard/lost-and-found')
            ->get("/dashboard/lost-and-found/{$delegate->username}")
            ->assertRedirect('/dashboard/lost-and-found');

        $this->assertNotNull($delegate->fresh()->claimed_at);
        $this->assertNotNull($delegate->fresh()->verification_token);
    }

    /** @test */
    public function delegates_cannot_claim_claimed_delegates()
    {
        $delegate = factory(Delegate::class)->create([
            'user_id'            => 2,
            'claimed_at'         => Carbon::now(),
            'verification_token' => null,
            'verified_at'        => Carbon::now(),
        ]);

        $this
            ->actingAs($this->createDelegate())
            ->from('dashboard/lost-and-found')
            ->get("/dashboard/lost-and-found/{$delegate->username}")
            ->assertRedirect('/dashboard/lost-and-found');

        $this->assertNull($delegate->fresh()->verification_token);
    }
}
