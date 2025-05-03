<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Illuminate\Console\Command;

class UpdateAuctionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-auction-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = now();

        Auction::where('start_time', '<=', $currentTime)
               ->where('status', 'pending')
               ->update(['status' => 'started']);
    }
}
