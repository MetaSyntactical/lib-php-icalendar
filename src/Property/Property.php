<?php

namespace MetaSyntactical\Icalendar\Property;

abstract class Property
{
    private $propertyName;

    private $propertyDelimiter = ":";

    protected function setPropertyName($propertyName)
    {
        $this->propertyName = $propertyName;

        return $this;
    }

    protected function setPropertyDelimiter($delimiter)
    {
        $this->propertyDelimiter = $delimiter;

        return $this;
    }

    final public function serialize()
    {
        return sprintf(
            "%s%s%s",
            $this->propertyName,
            $this->propertyDelimiter,
            $this->serializeValue()
        );
    }

    abstract public function configure();

    abstract protected function serializeValue();
}
