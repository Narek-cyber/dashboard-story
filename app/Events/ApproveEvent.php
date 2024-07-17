<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;

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
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('approve-channel'),
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'approve-event';
    }

    /**
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'status' => 'success',
            'story' => $this->story,
        ];
    }

    /**
     * @return void
     */
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}
