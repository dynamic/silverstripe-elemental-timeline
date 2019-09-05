<?php

namespace Dynamic\Elements\Test\Element;

use Dynamic\Elements\Timeline\Element\ElementTimeline;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

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
}
