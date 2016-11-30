<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FeedModel;

class feed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:update';

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
        if (!FeedModel::where('active', 0)->update(['active' => 1])) {
            die('Failed to update status');
        }

        die('Successful status update!');
    }
}
