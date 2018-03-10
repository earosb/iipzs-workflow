<?php

namespace App\Listeners;

use App\Events\ObservationCreated as Event;
use App\Notifications\ObservationCreated;
use Illuminate\Support\Facades\Notification;

class SendNewObservationNotification
{

    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $users = $event->observation->type->notifyByDefault;
        Notification::send($users, new ObservationCreated($event->observation));
    }
}
