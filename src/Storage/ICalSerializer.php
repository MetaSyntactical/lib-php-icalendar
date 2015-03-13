<?php

namespace MetaSyntactical\Icalendar\Storage;

use MetaSyntactical\Icalendar\Object\Object;
use MetaSyntactical\Icalendar\Property\Property;
use SplObjectStorage;

class ICalSerializer extends Serializer
{
    /**
     * @var SplObjectStorage
     */
    private $properties;

    public function __construct()
    {
        $this->properties = new SplObjectStorage();
    }

    public function serialize(Object $object)
    {
        $object->serialize($this);

        return $this;
    }

    public function getStream()
    {
        $stream = fopen("php://temp", "rwb");
        foreach ($this->properties as $property) {
            /** @var Property $property */
            fwrite($stream, $property->serialize());
        }

        rewind($stream);
        return $stream;
    }

    public function addProperty(Property $property)
    {
        $this->properties->attach($property);
    }
}
