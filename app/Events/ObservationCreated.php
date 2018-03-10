<?php

namespace App\Events;

use App\Observation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ObservationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Observation
     */
    public $observation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Observation $observation)
    {
        $this->observation = $observation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('observations');
    }
}
