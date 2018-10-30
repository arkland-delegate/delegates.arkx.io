<?php

namespace App\Console\Commands\Polling;

use App\Services\Ark\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PollSupply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:supply';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        Cache::rememberForever('supply', function () use ($client) {
            return $client->supply();
        });
    }
}
