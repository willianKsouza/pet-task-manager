<?php

namespace App\Listeners;

use App\Events\TaskCreatedEvent;
use App\Jobs\NotifyTaskCreatedJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnTaskCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreatedEvent $event): void
    {
        NotifyTaskCreatedJob::dispatch($event->task);
    }
}
