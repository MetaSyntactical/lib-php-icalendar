<?php

namespace MetaSyntactical\Icalendar\Object;

use Assert\Assertion;
use DateInterval;
use DateTime;
use MetaSyntactical\Icalendar\Property\BeginProperty;
use MetaSyntactical\Icalendar\Property\DateEndProperty;
use MetaSyntactical\Icalendar\Property\DateStartProperty;
use MetaSyntactical\Icalendar\Property\EndProperty;
use MetaSyntactical\Icalendar\Property\SummaryProperty;
use MetaSyntactical\Icalendar\Storage\Serializer;

class Event extends Object
{
    /**
     * @var string
     */
    private $summary;

    /**
     * @var bool
     */
    private $isAllDayEvent = false;

    /**
     * @var DateTime
     */
    private $dateStart;

    /**
     * @var DateTime
     */
    private $dateEnd;

    public function __construct($summary, DateTime $start, DateTime $end = null, $isAllDay = false)
    {
        $this->setSummary($summary);
        $this->setDateStart($start);
        if (is_null($end)) {
            $end = clone $start;
            $isAllDay = true;
        }
        $this->setDateEnd($end);
        $this->setAllDayEvent($isAllDay);
    }

    public function setDateStart(DateTime $dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function setDateEnd(DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function setSummary($summary)
    {
        Assertion::notBlank($summary);

        $this->summary = $summary;

        return $this;
    }

    public function setAllDayEvent($flag = true)
    {
        Assertion::boolean($flag);

        $this->isAllDayEvent = $flag;

        return $this;
    }

    public function serialize(Serializer $serializer)
    {
        $serializer->addProperty(new BeginProperty("VEVENT"));
        $serializer->addProperty(new SummaryProperty($this->summary));

        $serializer->addProperty(new DateStartProperty($this->dateStart, !$this->isAllDayEvent));
        $end = clone $this->dateEnd;
        if ($this->isAllDayEvent) {
            $end->add(new DateInterval("P1D"));
        }
        $serializer->addProperty(new DateEndProperty($end, !$this->isAllDayEvent));

        $serializer->addProperty(new EndProperty("VEVENT"));
    }
}
