<?php

namespace App\Jobs;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnableAutomatedAnnouncements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(Announcement $announcements): void
    {
        $announcements
            ->where('visible_till', '>', date('Y-m-d H:i:s'))
            ->where('visible', false)
            ->where('published_at','<=', date('Y-m-d H:i:s'))
            ->update(['visible' => true]);
    }
}
