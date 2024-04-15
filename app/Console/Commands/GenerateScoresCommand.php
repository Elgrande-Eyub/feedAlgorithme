<?php

namespace App\Console\Commands;

use App\Http\Controllers\algorithme;
use App\Models\Thread;
use Illuminate\Console\Command;

class GenerateScoresCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scores:generate';

    protected $description = 'Generate scores for threads';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
