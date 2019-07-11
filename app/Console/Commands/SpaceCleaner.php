<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trash;
use Carbon\Carbon;
use App\Http\Controllers\Admin\TrashController;

class SpaceCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'space:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        TrashController::scheduledCleanUp();
    }
}