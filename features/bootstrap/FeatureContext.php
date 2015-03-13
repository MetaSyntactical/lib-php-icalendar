<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use MetaSyntactical\Icalendar\Object\Calendar;
use MetaSyntactical\Icalendar\Object\Event;
use MetaSyntactical\Icalendar\Storage\ICalSerializer;
use MetaSyntactical\Icalendar\Storage\Serializer;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Calendar[]
     */
    private $calendars = array();

    /**
     * @var Serializer[]
     */
    private $serializer = array();

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have a calendar :arg1
     */
    public function iHaveACalendar($arg1)
    {
        $this->calendars[$arg1] = new Calendar();
    }

    /**
     * @Given I have one event named :arg1 in the calendar :arg2
     */
    public function iHaveOneEventNamedInTheCalendar($arg1, $arg2)
    {
        if (!isset($this->calendars[$arg2])) {
            throw new DomainException("Missing calendar $arg2.");
        }
        $this->calendars[$arg2]->addEvent(
            new Event($arg1)
        );
    }

    /**
     * @When I serialize the calendar :arg1 in :arg2 format
     * @When I serialize the calendar :arg1
     */
    public function iSerializeTheCalendar($arg1, $arg2 = "iCalendar")
    {
        if (!isset($this->calendars[$arg1])) {
            throw new DomainException("Missing calendar $arg1.");
        }

        if ($arg2 !== "iCalendar") {
            throw new DomainException("Unknown serializer format $arg2.");
        }

        $serializer = new ICalSerializer();
        $this->serializer[$arg1] = $serializer->serialize($this->calendars[$arg1]);
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        var_dump($string->getStrings());
        $contents = stream_get_contents(end($this->serializer)->getStream());
        var_dump($contents);
        throw new PendingException();
    }

}
