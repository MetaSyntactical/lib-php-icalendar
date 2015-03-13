<?php

namespace MetaSyntactical\Icalendar\Property;

use PHPUnit_Framework_TestCase;

class BeginPropertyTest extends PHPUnit_Framework_TestCase
{
    public function provideCreation()
    {
        return array(
            array(
                "VCALENDAR",
                null,
                "BEGIN:VCALENDAR",
            ),
            array(
                "VEVENT",
                null,
                "BEGIN:VEVENT",
            ),
            array(
                "UNKNOWN_FAILED",
                "Assert\\AssertionFailedException",
            )
        );
    }

    /**
     * @dataProvider provideCreation()
     */
    public function testSerialize(
        $objectType, $expectedException = null, $expectedSerialize = null
    )
    {
        if (!is_null($expectedException)) {
            $this->setExpectedException($expectedException);
        }

        $object = new BeginProperty($objectType);
        self::assertEquals($expectedSerialize, $object->serialize());
    }
}
