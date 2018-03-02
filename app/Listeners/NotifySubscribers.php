<?php

namespace App\Listeners;

use App\Events\ObservationReceivedNewComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
{


    /**
     * Handle the event.
     *
     * @param  ObservationReceivedNewComment  $event
     * @return void
     */
    public function handle(ObservationReceivedNewComment $event)
    {
        logger('NotifySubscribers');
    }
}
