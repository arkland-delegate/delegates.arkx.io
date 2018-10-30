<?php

namespace App\Console\Commands\Cache;

use App\Models\Delegate;
use App\Services\Ark\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheCalculator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:cache:calculator';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        Cache::forget('calculator');

        Cache::rememberForever('calculator', function () {
            return Delegate::forging()->get()->map(function ($delegate) {
                return [
                    'rank'         => $delegate->rank,
                    'username'     => $delegate->username,
                    'share'        => $delegate->sharing['percentage'],
                    'votes'        => $delegate->votes,
                    'excluded'     => $delegate->excludedVoters()->sum('balance'),
                    'productivity' => $delegate->statistics['productivity'],
                    'approval'     => $delegate->statistics['approval'],
                    'settings'     => [
                        'sharing'    => $delegate->sharing,
                        'voting'     => $delegate->voting,
                        'calculator' => $delegate->calculator,
                    ],
                ];
            });
        });
    }
}
