<?php

namespace Dynamic\Elements\Timeline\Tests\Model;

use Dynamic\Elements\Timeline\Model\TimelineObject;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class TimelineObjectTest extends SapphireTest
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
        $object = $this->objFromFixture(TimelineObject::class, 'milestone_one');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
        $this->assertNotNull($fieldset->dataFieldByName('Year'));
    }

    public function testCMSFieldsRemovesRelationAndSortFields()
    {
        $object = $this->objFromFixture(TimelineObject::class, 'milestone_one');
        $fieldset = $object->getCMSFields();

        $this->assertNull($fieldset->dataFieldByName('ElementTimelineID'));
        $this->assertNull($fieldset->dataFieldByName('SortOrder'));
    }
}
