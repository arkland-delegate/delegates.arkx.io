<?php

namespace Tests\Feature\Http\Front\Announcements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_can_search_announcements()
    {
        $announcement = $this->createAnnouncement();

        $this
            ->post('/announcements/search', ['search' => $announcement->title])
            ->assertSuccessful()
            ->assertSee($announcement->title);
    }
}
