<?php

namespace Tests\Feature\Http\Front\Announcements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_announcement_list()
    {
        $this
            ->get('/announcements')
            ->assertSuccessful();
    }
}
