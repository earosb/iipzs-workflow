<?php

namespace App\Listeners;

use App\Events\IssueCreated as Event;
use App\Notifications\IssueCreated;
use Illuminate\Support\Facades\Notification;

class SendNewIssueNotification
{

    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $users = $event->issue->subscribers;
        
        Notification::send($users, new IssueCreated($event->issue));
    }
}
