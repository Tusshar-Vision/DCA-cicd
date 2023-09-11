<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session as FacadesSession;

class session extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush all the sessions data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FacadesSession::flush();
        $this->info('All sessions flushed succesfully');
    }
}
