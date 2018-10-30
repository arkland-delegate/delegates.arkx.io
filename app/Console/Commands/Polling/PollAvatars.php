<?php

namespace App\Console\Commands\Polling;

use App\Models\Delegate;
use App\Services\Ark\Client;
use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use Illuminate\Console\Command;

class PollAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:avatars';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        $client = GuzzleFactory::make([
            'base_uri'        => 'https://www.arkvatar.com/arkvatar/',
            'allow_redirects' => false,
        ]);

        Delegate::all()->each(function ($delegate) use ($client) {
            if (!$delegate->extra_attributes->profile['logo']) {
                $this->line('Polling Block: <info>'.$delegate['username'].'</info>');

                $response = $client->get($delegate['address']);

                $delegate->extra_attributes->set('profile.logo', $response->getHeader('Location')[0]);
                $delegate->save();
            }
        });
    }
}
