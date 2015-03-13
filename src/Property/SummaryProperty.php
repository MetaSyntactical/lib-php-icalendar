<?php

namespace MetaSyntactical\Icalendar\Property;

use Assert\Assertion;

class SummaryProperty extends Property
{
    private $summaryText;

    public function __construct($summaryText)
    {
        $this->setSummaryText($summaryText);
    }

    public function setSummaryText($summaryText)
    {
        Assertion::notBlank($summaryText);

        $this->summaryText = $summaryText;

        return $this;
    }

    public function configure()
    {
        $this->setPropertyName("SUMMARY");
    }

    protected function serializeValue()
    {
        return $this->summaryText;
    }

}
