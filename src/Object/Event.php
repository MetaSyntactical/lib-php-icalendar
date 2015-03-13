<?php

namespace MetaSyntactical\Icalendar\Object;

use Assert\Assertion;
use MetaSyntactical\Icalendar\Storage\Serializer;

class Event extends Object
{
    /**
     * @var string
     */
    private $summary;

    public function __construct($summary)
    {
        $this->setSummary($summary);
    }

    public function setSummary($summary)
    {
        Assertion::notBlank($summary);

        $this->summary = $summary;

        return $this;
    }

    public function serialize(Serializer $serialier)
    {
        // TODO: Implement accept() method.
    }
}
