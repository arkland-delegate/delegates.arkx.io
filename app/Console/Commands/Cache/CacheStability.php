<?php

namespace App\Console\Commands\Cache;

use App\Models\Delegate;
use App\Services\Ark\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheStability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:cache:stablity';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        // Top 51...
        $delegates = Delegate::forging()->get();

        // Rank 52...
        $lowestRank = $delegates->last()->votes;

        // Calculate stability...
        $delegates = $delegates->map(function ($delegate) use ($lowestRank) {
            $voters = $delegate->voters()->orderBy('balance', 'desc')->get();

            $lostVotes = 0;
            $lostVoters = 0;

            foreach ($voters as $voter) {
                $delegate->votes -= $voter->balance;

                $lostVotes += $voter->balance;
                $lostVoters++;

                // Dropped out...
                if ($delegate->votes <= $lowestRank) {
                    return [
                        'username'  => $delegate->username,
                        'stability' => ($lostVoters / $lostVotes) * ARKTOSHI,
                    ];
                }
            }
        })->sortBy('stability');

        // Normalise stability...
        $delegates = $delegates->map(function ($delegate) use ($delegates) {
            $stability = $delegate['stability'];
            $stability /= $delegates->last()['stability'];
            $stability *= 100;

            $delegate['stability'] = round($stability, 4);

            return $delegate;
        })->each(function ($delegate) {
            Cache::remember($delegate['username'].':stability', 10, function () use ($delegate) {
                return $delegate['stability'];
            });
        });
    }
}
