<?php

namespace App\Console\Commands\Polling;

use App\Models\Delegate;
use App\Services\Ark\Client;
use Illuminate\Console\Command;

class PollVotersCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:voters-count';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        foreach (Delegate::all() as $delegate) {
            $this->line('Polling Voters: <info>'.$delegate['username'].'</info>');

            $votersList = collect($client->voters($delegate['public_key']));

            $delegate->extra_attributes->set('statistics.voters', $votersList->count());
            $delegate->save();
        }
    }
}
