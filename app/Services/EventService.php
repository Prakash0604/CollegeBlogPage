<?php

namespace App\Services;

use App\Models\Event;
use App\Services\Main\BaseService;

class EventService extends BaseService
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
        parent::__construct($event);  // Calling the parent constructor with Event model
    }

    // You can add additional methods specific to events here
}
