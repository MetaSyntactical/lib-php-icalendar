<?php

namespace MetaSyntactical\Icalendar\Property;

class DateEndProperty extends DateStartProperty
{
    public function configure()
    {
        parent::configure();
        $this->setPropertyName("DTEND");
    }

}
