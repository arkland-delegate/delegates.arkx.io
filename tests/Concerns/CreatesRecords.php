<?php

namespace Tests\Concerns;

use App\Models\Announcement;
use App\Models\Delegate;
use App\Models\Status;
use App\Models\User;

trait CreatesRecords
{
    public function createAnnouncement(array $overrides = []): Announcement
    {
        return factory(Announcement::class)->create($overrides);
    }

    public function createStatus(array $overrides = []): Status
    {
        return factory(Status::class)->create($overrides);
    }

    public function createUser(array $overrides = []): User
    {
        return factory(User::class)->create($overrides);
    }

    public function createAdministrator(array $overrides = []): User
    {
        return $this->createUser($overrides)->assignRole('admin');
    }

    public function createDelegate(array $overrides = []): User
    {
        return $this->createUser($overrides)->assignRole('delegate');
    }
}
