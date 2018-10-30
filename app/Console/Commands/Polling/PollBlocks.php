<?php

namespace App\Console\Commands\Polling;

use App\Events\BlockWasMissed;
use App\Models\Delegate;
use App\Services\Ark\Client;
use Illuminate\Console\Command;

class PollBlocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:blocks';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        $delegates = Delegate::forging()->get();

        foreach ($delegates as $delegate) {
            $this->line('Polling Block: <info>'.$delegate['username'].'</info>');

            $block = $client->lastBlock($delegate['public_key']);

            $delegate->extra_attributes->last_block = (string) humanize_epoch($block['timestamp']);
            $delegate->save();

            $this->triggerEvent($delegate);
        }
    }

    /**
     * Decide if we trigger an event.
     *
     * @param \App\Models\Delegate $delegate
     */
    private function triggerEvent(Delegate $delegate): void
    {
        if ('red' === $delegate->status) {
            event(new BlockWasMissed($delegate));
        }
    }
}
