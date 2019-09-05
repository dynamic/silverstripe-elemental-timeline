<?php

namespace Dynamic\Elements\Test\Element;

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
        $object = $this->objFromFixture(TimelineObject::class, 'default');
        $fieldset = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fieldset);
        $this->assertNotNull($fieldset->dataFieldByName('Year'));
    }
}
