<?php

namespace App\Listeners;

use App\Events\IssueCommented as Event;
use App\Notifications\IssueCommented;
use Illuminate\Support\Facades\Notification;

class SendIssueCommentedNotification
{
    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $users = $event->comment->issue->subscribers;
        $users->push($event->comment->issue->createdBy);
        $users->push($event->comment->issue->assignedTo);


        $users->each(function ($user) use ($event) {
            logger('users', $user->toArray());
            Notification::send($user, new IssueCommented($event->comment));
        });
    }
}
