<?php

namespace App\Console\Commands\Migrate;

use App\Models\Delegate;
use Illuminate\Console\Command;

class Percentages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:migrate:shares';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $delegates = [
            [
                'username'   => 'biz_classic',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'arkpool',
                'type'       => 'public',
                'percentage' => 80,
            ], [
                'username'   => 'dutchdelegate',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'bioly',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'axi',
                'type'       => 'public',
                'percentage' => 80,
            ], [
                'username'   => 'goose',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'ravelou',
                'type'       => 'public',
                'percentage' => 100,
            ], [
                'username'   => 'pieface',
                'type'       => 'public',
                'percentage' => 96,
            ], [
                'username'   => 'yin',
                'type'       => 'private',
                'percentage' => 100,
            ], [
                'username'   => 'thefoundry',
                'type'       => 'public',
                'percentage' => 91,
            ], [
                'username'   => 'doc',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'del',
                'type'       => 'public',
                'percentage' => 96,
            ], [
                'username'   => 'chris',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'arkland',
                'type'       => 'public',
                'percentage' => 93,
            ], [
                'username'   => 'therock',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'thegoldenhorde',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'biz_private',
                'type'       => 'private',
                'percentage' => 95,
            ], [
                'username'   => 'kolap',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'dr10',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'superstar',
                'type'       => 'private',
                'percentage' => 80,
            ], [
                'username'   => 'calidelegate',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'arkx',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'pitbull',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'arkgallery',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'fun',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'tibonos',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'cryptology',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'bbclubark',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'emotive_ark',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'hippopotamus',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'itsanametoo',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'ark.business',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'jarunik',
                'type'       => 'public',
                'percentage' => 0,
            ], [
                'username'   => 'arkane',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'arkship',
                'type'       => 'public',
                'percentage' => 93,
            ], [
                'username'   => 'rasputin',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'samuray',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'arky',
                'type'       => 'public',
                'percentage' => 60,
            ], [
                'username'   => 'arkade_delegate',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'toad',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'quarkpool',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'deadlock',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'ghostfaceuk',
                'type'       => 'public',
                'percentage' => 85,
            ], [
                'username'   => 'arknet',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'ares',
                'type'       => 'private',
                'percentage' => 0,
            ], [
                'username'   => 'arkworld',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'arkmoon',
                'type'       => 'public',
                'percentage' => 95,
            ], [
                'username'   => 'dafty',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'arkoar.group',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'locama',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'united',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'ozpooldelegate',
                'type'       => 'public',
                'percentage' => 96,
            ], [
                'username'   => 'wes',
                'type'       => 'public',
                'percentage' => 90,
            ], [
                'username'   => 'jamiec79',
                'type'       => 'public',
                'percentage' => 93,
            ],
        ];

        foreach ($delegates as $migration) {
            try {
                $delegate = Delegate::findByUsername($migration['username']);
                $delegate->update(['type' => $migration['type']]);

                $delegate->extra_attributes->set('sharing.percentage', $migration['percentage']);
                $delegate->save();
            } catch (\Exception $e) {
                dump($delegate);
                dump($e->getMessage());
            }
        }
    }
}
