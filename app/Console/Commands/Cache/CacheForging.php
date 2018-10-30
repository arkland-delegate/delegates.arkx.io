<?php

namespace App\Console\Commands\Cache;

use App\Models\Delegate;
use App\Services\Ark\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheForging extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:cache:forging';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        Cache::forget('forging.totals');

        Cache::rememberForever('forging.totals', function () use ($client) {
            $delegates = Delegate::get();
            $votes = $delegates->sum('votes');
            $supply = Cache::get('supply');

            return [
                'voters'        => $delegates->sum('voter_count'),
                'votes_percent' => round($delegates->sum('extra_attributes.statistics.approval'), 2),
                'votes'         => number_format($votes / ARKTOSHI),
                'supply'        => number_format($supply / ARKTOSHI),
                'supply_left'   => number_format(($supply - $votes) / ARKTOSHI),
            ];
        });
    }
}
