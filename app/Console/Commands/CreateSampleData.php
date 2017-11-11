<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateSampleData extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'recruiting:sample-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Data.json file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle($input, $output=NULL)
    {

        $data  = [
           'customers' => [
                'Widget Co',
                'Synergy Inc',
                'Elevation Executives',
                'Momentum Partners',
            ],

            'features' => [
                'A',
                'B',
                'C',
                'D',
            ],

            'feature_groups' => [

                [
                    'name' => 'Group 1',
                    'percentage' => '10',
                    'features' => [
                        'A',
                        'B'
                    ],
                ],
                [
                    'name' => 'Group 2',
                    'percentage' => '20',
                    'features' => [
                        'B',
                        'C'
                    ],
                ],
                [
                    'name' => 'Group 3',
                    'percentage' => '20',
                    'features' => [
                        'C',
                    ],
                ],
                [
                    'name' => 'Group 4',
                    'percentage' => '50',
                    'features' => [
                        'A',
                        'B',
                        'C',
                        'D',
                    ],
                ],

            ]
        ];



        $data = json_encode($data, JSON_PRETTY_PRINT);
        echo $data;
        Storage::disk('local')->put('data.json', $data);

    }

}