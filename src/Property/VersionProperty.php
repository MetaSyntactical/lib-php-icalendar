<?php

namespace MetaSyntactical\Icalendar\Property;

class VersionProperty extends Property
{
    public function configure()
    {
        $this->setPropertyName("VERSION");
    }

    protected function serializeValue()
    {
        return "2.0";
    }

}
