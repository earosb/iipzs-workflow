<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Issue;
use App\Events\IssueCreated;
use App\Notifications\IssueAssigned;
use App\Notifications\SendNewIssueNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class IssueTest extends TestCase
{
    /** @test */
    public function it_dispatch_events_on_created()
    {
        Event::fake();
        Notification::fake();

        $issue = factory(Issue::class)->create();

        Event::assertDispatched(IssueCreated::class, function ($e) use ($issue) {
            return $e->issue->id === $issue->id;
        });

        Notification::assertNotSentTo(
            $issue->assignedTo,
            SendNewIssueNotification::class,
            function ($notification, $channels) use ($issue) {
                return $notification->issue->id === $issue->id;
            }
        );

        Notification::assertSentTo(
            $issue->assignedTo,
            IssueAssigned::class,
            function ($notification, $channels) use ($issue) {
                return $notification->issue->id === $issue->id;
            }
        );
    }
}
