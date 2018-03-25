<?php

namespace App\Listeners;

use App\Notifications\IssueAssigned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\IssueCreated as Event;
use Illuminate\Support\Facades\Notification;

class SendNewIssueAssignedNotification
{
    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $user = $event->issue->assignedTo;
        Notification::send($user, new IssueAssigned($event->issue));
    }
}
