<?php

namespace Tests\Feature\Http\Front\Announcements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_announcement()
    {
        $announcement = $this->createAnnouncement();

        $this
            ->get("/announcements/{$announcement->slug}")
            ->assertSuccessful();
    }
}
