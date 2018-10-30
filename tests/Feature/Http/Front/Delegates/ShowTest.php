<?php

namespace Tests\Feature\Http\Front\Delegates;

use App\Models\Delegate;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_delegate()
    {
        $delegate = factory(Delegate::class)->create();

        $this
            ->get("/delegates/{$delegate->username}")
            ->assertSuccessful();
    }
}
