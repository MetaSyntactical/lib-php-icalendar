<?php

namespace MetaSyntactical\Icalendar\Property;

use Assert\Assertion;
use DateTime;
use DateTimeZone;

class DateStartProperty extends Property
{
    /**
     * @var DateTime
     */
    private $date;

    private $hasTime = true;

    private $renderTimeZone = false;

    public function __construct(DateTime $date, $hasTime = true, $renderTimeZone = false)
    {
        $this->configure();

        $this->setDate($date);
        $this->setHasTime($hasTime);
        $this->setRenderTimeZone($renderTimeZone);
    }

    public function setDate(DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function setHasTime($hasTime)
    {
        Assertion::boolean($hasTime);

        $this->hasTime = $hasTime;

        return $this;
    }

    public function setRenderTimeZone($renderTimeZone)
    {
        Assertion::boolean($renderTimeZone);

        $this->renderTimeZone = $renderTimeZone;

        return $this;
    }

    public function configure()
    {
        $this->setPropertyName("DTSTART");
        $this->setPropertyDelimiter(";");
    }

    protected function serializeValue()
    {
        $date = clone $this->date;
        $result = "";
        if ($this->renderTimeZone) {

        }
        $result .= ";VALUE=DATE:";
        $result .= $date->format("Ymd");
        if ($this->hasTime) {
            $result .= "T";
            $result .= $date->format("His");
            if (!$this->renderTimeZone) {
                $result .= "Z";
            }
        }

        return trim($result, ";");
    }

}
