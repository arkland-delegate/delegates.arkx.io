<?php

namespace App\Console\Commands\Maintain;

use App\Models\Delegate;
use Illuminate\Console\Command;

class Delegates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:maintain:delegates';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Delegate::pending()->each(function ($delegate) {
            if ($delegate->claimHasExpired()) {
                $delegate->reset();
            }
        });
    }
}
