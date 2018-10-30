<?php

namespace App\Console\Commands\Polling;

use App\Events\VoteWasShifted;
use App\Models\Delegate;
use App\Models\Voter;
use App\Services\Ark\Client;
use Illuminate\Console\Command;

class PollVoters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:voters';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        $delegates = Delegate::all();

        foreach ($delegates as $delegate) {
            $this->line('Polling Voters: <info>'.$delegate['username'].'</info>');

            // Current vote data...
            $votesBefore = $delegate->voters()->sum('balance');
            $activeVoters = $delegate->voters()->pluck('address');

            // Store voters...
            $votersList = collect($client->voters($delegate['public_key']));

            // Update each voter...
            foreach ($votersList as $voter) {
                $this->line('Polling Voter: <info>'.$voter['address'].'</info>');

                // Update...
                $delegate->voters()->updateOrCreate([
                    'address' => $voter['address'],
                ], $voter);

                // Used to be a voter...
                $wasVoting = $activeVoters->contains($voter['address']);
                $noLongerVoting = !$votersList->pluck('address')->contains($voter['address']);

                if ($wasVoting && $noLongerVoting) {
                    Voter::whereAddress($voter['address'])->delete();
                }
            }

            // Compare votes count...
            $votesAfter = $delegate->voters()->sum('balance');

            $this->triggerEvent($delegate, $votesBefore, $votesAfter);
        }
    }

    /**
     * Decide if we trigger an event.
     *
     * @param \App\Models\Delegate $delegate
     * @param int                  $oldFigure
     * @param int                  $newFigure
     */
    private function triggerEvent(Delegate $delegate, int $oldFigure, int $newFigure): void
    {
        if ($oldFigure <= 0 || $newFigure <= 0) {
            return;
        }

        $percentChange = abs((1 - $oldFigure / $newFigure) * 100);

        if ($percentChange >= 1) {
            event(new VoteWasShifted($delegate));
        }
    }
}
