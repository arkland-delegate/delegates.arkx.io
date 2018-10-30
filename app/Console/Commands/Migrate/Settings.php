<?php

namespace App\Console\Commands\Migrate;

use App\Models\Delegate;
use Illuminate\Console\Command;

class Settings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:migrate:settings';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $delegates = Delegate::all();

        foreach ($delegates as $delegate) {
            $delegate->extra_attributes->set('sharing.running_balance', 'yes');
            $delegate->extra_attributes->set('sharing.covers_fee', 'yes');
            $delegate->extra_attributes->set('voting.requirements.registration', 'no');
            $delegate->extra_attributes->set('calculator.cap_at_maximum_balance', 'no');
            $delegate->extra_attributes->set('calculator.ignore_above_maximum_balance', 'no');
            $delegate->save();
        }
    }
}
