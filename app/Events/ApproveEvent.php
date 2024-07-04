<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $story;

    /**
     * Create a new event instance.
     */
    public function __construct($story)
    {
        $this->story = $story;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('approve-channel'),
        ];
    }

    public function broadcastAs()
    {
        return 'approve-event';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => "OK"
        ];
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}
