<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\IssueCreated' => [
            'App\Listeners\SendNewIssueNotification',
            'App\Listeners\SendNewIssueAssignedNotification'
        ],
        'App\Events\IssueCommented' => [
            'App\Listeners\SendIssueCommentedNotification'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
