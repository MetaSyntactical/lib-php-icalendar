<?php

namespace MetaSyntactical\Icalendar\Storage;

use MetaSyntactical\Icalendar\Object\Object;
use MetaSyntactical\Icalendar\Property\Property;

abstract class Serializer
{
    abstract public function serialize(Object $object);

    abstract public function addProperty(Property $property);
}
