<?php

namespace Modularization\Core\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogUploadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $path, $type;

    public function __construct($path, $type = "image")
    {
        $this->path = $path;
        $this->type = $type;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
