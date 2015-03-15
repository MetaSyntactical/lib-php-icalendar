<?php

namespace MetaSyntactical\Icalendar\Object;

use MetaSyntactical\Icalendar\Property\BeginProperty;
use MetaSyntactical\Icalendar\Property\EndProperty;
use MetaSyntactical\Icalendar\Property\VersionProperty;
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
        $serializer->addProperty(new BeginProperty("VCALENDAR"));
        $serializer->addProperty(new VersionProperty());

        foreach ($this->events as $event) {
            /** @var Event $event */
            $event->serialize($serializer);
        }

        $serializer->addProperty(new EndProperty("VCALENDAR"));
    }

    public function addEvent(Event $event)
    {
        $this->events->attach($event);
    }
}
