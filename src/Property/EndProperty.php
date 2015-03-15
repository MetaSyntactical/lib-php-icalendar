<?php

namespace MetaSyntactical\Icalendar\Property;

use Assert\Assertion;

class EndProperty extends Property
{
    private $allowedObjectTypes = array(
        "VCALENDAR",
        "VEVENT"
    );

    private $objectType;

    public function __construct($objectType)
    {
        $this->configure();

        $this->setObjectType($objectType);
    }

    public function setObjectType($objectType)
    {
        Assertion::inArray($objectType, $this->allowedObjectTypes);

        $this->objectType = $objectType;

        return $this;
    }

    public function configure()
    {
        $this->setPropertyName("END");
    }

    public function serializeValue()
    {
        return $this->objectType;
    }
}
