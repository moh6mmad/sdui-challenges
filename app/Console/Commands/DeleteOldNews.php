<?php

namespace App\Console\Commands;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleting all news entries older than 14 days';

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
     * @return int
     */
    public function handle()
    {
        return News::where( 'created_at', '>', Carbon::now()->subDays(14))->delete();
    }
}
