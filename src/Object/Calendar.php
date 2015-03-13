<?php

namespace MetaSyntactical\Icalendar\Object;

use MetaSyntactical\Icalendar\Storage\Serializer;
use SplObjectStorage;

class Calendar extends Object
{
    /**
     * @var SplObjectStorage
     */
    private $events;

    public function __construct()
    {
        $this->events = new SplObjectStorage();
    }

    public function serialize(Serializer $serializer)
    {
        // TODO: Implement accept() method.
    }

    public function addEvent(Event $event)
    {
        $this->events->attach($event);
    }
}
