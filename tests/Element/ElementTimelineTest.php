<?php

namespace Dynamic\Elements\Timeline\Tests\Element;

use Dynamic\Elements\Timeline\Element\ElementTimeline;
use Dynamic\Elements\Timeline\Model\TimelineObject;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class ElementTimelineTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'default');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
        $this->assertNotNull($fieldset->dataFieldByName('Milestones'));
    }

    public function testMilestonesGridFieldConfig()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'default');
        $fieldset = $object->getCMSFields();

        $milestones = $fieldset->dataFieldByName('Milestones');
        $config = $milestones->getConfig();

        $this->assertNotNull($config->getComponentByType(GridFieldOrderableRows::class));
        $this->assertNull($config->getComponentByType(GridFieldAddExistingAutocompleter::class));
        $this->assertNull($config->getComponentByType(GridFieldDeleteAction::class));
    }

    public function testGetMilestonesListOrdersBySortOrder()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'default');
        $milestones = $object->getMilestonesList();

        $this->assertSame(
            [
                $this->objFromFixture(TimelineObject::class, 'milestone_two')->ID,
                $this->objFromFixture(TimelineObject::class, 'milestone_one')->ID,
            ],
            $milestones->column('ID')
        );
    }

    public function testGetMilestonesListIsScopedToOwningElement()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'default');
        $otherMilestone = $this->objFromFixture(TimelineObject::class, 'other_milestone');

        $this->assertNotContains($otherMilestone->ID, $object->getMilestonesList()->column('ID'));
    }

    public function testGetSummary()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'default');

        $this->assertSame('2 milestones', $object->getSummary());
    }

    public function testGetSummarySingular()
    {
        $object = $this->objFromFixture(ElementTimeline::class, 'single_milestone');

        $this->assertSame('1 milestone', $object->getSummary());
    }
}
