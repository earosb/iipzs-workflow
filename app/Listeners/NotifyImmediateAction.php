<?php

namespace App\Listeners;

use App\Events\ObservationReceivedNewComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NotifyImmediateAction as NotifyEmail;
use Illuminate\Support\Facades\Mail;

class NotifyImmediateAction
{

    /**
     * Handle the event.
     *
     * @param  ObservationReceivedNewComment  $event
     * @return void
     */
    public function handle(ObservationReceivedNewComment $event)
    {
        logger('NotifyImmediateAction', [ $event->comment->immediateAction->name ]);
        Mail::to($event->comment->immediateAction)->send(new NotifyEmail($event->comment));

//        Mail::to($request->user())
//            ->cc($moreUsers)
//            ->bcc($evenMoreUsers)
//            ->queue(new OrderShipped($order));

    }
}
