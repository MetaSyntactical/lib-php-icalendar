Feature: Create Calendar Event and serialize in iCalendar text format
  In order to have a calendar event to be imported in calendar applications
  As an API user
  I need to be able to create a calendar event and serialize it in iCalendar text format

Scenario: Serialize one event in a calendar
  Given I have a calendar "demo calendar"
  And I have one event named "demo event" in the calendar "demo calendar"
  When I serialize the calendar "demo calendar" in "iCalendar" format
  Then I should get:
    """
    BEGIN:VCALENDAR
    VERSION:2.0
    BEGIN:VEVENT
    SUMMARY:demo event
    """
