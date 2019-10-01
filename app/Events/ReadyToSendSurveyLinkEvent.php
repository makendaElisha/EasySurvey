<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReadyToSendSurveyLinkEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $category;
    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($category, $email)
    {
        $this->category = $category;
        $this->email = $email;
    }

}
