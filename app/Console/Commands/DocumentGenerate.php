<?php

namespace Uccello\DocumentDesigner\Console\Commands;

use Illuminate\Console\Command;
use Uccello\DocumentDesigner\Support\DocumentIO;

class DocumentGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test document designer with command line';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inFile     = "Template.docx";
        $outFile    = "Out.pdf";

        $path = storage_path("app/public/");

        $data = [
            'v01' => 'Root 01!',
            'v02' => 'Root 02!',
            't:T1.v01' => [
                [
                    'T1.v01' => 'VAR A 01!',
                    'v02' => 'VAR A 02!',
                    'i:i01' => 'storage/app/public/test01.png'
                ],
                [
                    'T1.v01' => 'VAR B 01!',
                    'v02' => 'VAR B 02!',
                ],
                [
                    'T1.v01' => 'VAR C 01!',
                    'v02' => 'VAR C 02!',
                ],
                [
                    'T1.v01' => 'VAR D 01!',
                    'v02' => 'VAR D 02!',
                    'i:i01' => 'storage/app/public/test02.jpg'
                ],
                [
                    'T1.v01' => 'VAR D 01!',
                    'v02' => 'VAR E 02!',
                ],
            ],
            'b:DA' => [
                [
                    'v01' => 'VAR A 01!',
                    'v02' => 'VAR A 02!',
                    't:T1.v01' => [
                        [
                            'T1.v01' => 'VAR DA1 T1 A 01!',
                            'check' => '☐'
                        ],
                        [
                            'T1.v01' => 'VAR DA1 T1 B 01!',
                            'check' => '☒'
                        ],
                        [
                            'T1.v01' => 'VAR DA1 T1 C 01!',
                            'check' => '☐'
                        ],
                    ],
                    't:T2.v01' => []
                    // 'b:B02' => [['v01' => 'B02.v01', 'v02' => 'B02.v02', 'b:B03' => [['v01' => 'B03.v01', 'v02' => 'B03.v02']]]],
                ],
                [
                    'v01' => 'VAR B 01!',
                    'v02' => 'VAR B 02!',
                    't:T1.v01' => [
                        [
                            'T1.v01' => 'VAR DA2 T1 A 01!',
                        ],
                        [
                            'T1.v01' => 'VAR DA2 T1 B 01!',
                        ],
                        [
                            'T1.v01' => 'VAR DA2 T1 C 01!',
                        ],
                        [
                            'T1.v01' => 'VAR DA2 T1 D 01!',
                        ],
                    ],
                    't:T2.v01' => [
                        [
                            'T2.v01' => 'VAR DA2 T2 A 01!',
                        ],
                        [
                            'T2.v01' => 'VAR DA2 T2 B 01!',
                        ],
                    ],
                    // 'b:B02' => [['v01' => 'B02.v01', 'v02' => 'B02.v02', 'b:B03' => [['v01' => 'B03.v01', 'v02' => 'B03.v02']]]],
                ],
                [
                    'v01' => 'VAR C 01!',
                    'v02' => 'VAR C 02!',
                    // 'b:B02' => [['v01' => 'B02.v01', 'v02' => 'B02.v02', 'b:B03' => [['v01' => 'B03.v01', 'v02' => 'B03.v02']]]],
                ],
            ]
        ];

        DocumentIO::process($path.$inFile, $path.$outFile, $data);
    }
}
