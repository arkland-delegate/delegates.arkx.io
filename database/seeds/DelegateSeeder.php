<?php

use App\Models\Channel;
use App\Models\Delegate;
use App\Models\Server;
use App\Models\Voter;
use Illuminate\Database\Seeder;

class DelegateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Delegate::class, 100)->create()->each(function ($delegate) {
            $delegate->servers()->saveMany(factory(Server::class, 2)->make());
            $delegate->channels()->saveMany(factory(Channel::class, 5)->make());
            $delegate->voters()->saveMany(factory(Voter::class, 5)->make());

            $delegate->syncTags(['tag 1', 'tag 2', 'tag 3']);
        });
    }
}
