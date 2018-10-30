<?php

namespace Tests\Feature\Http\Front\Delegates;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_delegates_list()
    {
        $this
            ->get('/delegates')
            ->assertSuccessful();
    }
}
