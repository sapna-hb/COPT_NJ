<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class StartQueueWorker extends Command
{
    protected $signature = 'queue:start-if-not-running';

    protected $description = 'Check if queue worker is running and start it if not';

    public function handle()
    {
        // Check if the queue worker is running by checking for a running process
        $output = shell_exec('pgrep -f "php artisan queue:work"');
        \Log::info('running');

        if (empty($output)) {
            $this->info('Queue worker is not running, starting it now...');
            // Start the queue worker
            Artisan::call('queue:work', [
                '--daemon' => true,
            ]);
        } else {
            $this->info('Queue worker is already running.');
        }
    }
}
