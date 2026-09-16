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

    /**
     * Regression test: dataFieldByName() finds a field recursively, so it stays
     * non-null even when the field has been (incorrectly) spliced inside another
     * field's CompositeField as an unexpected third child -- which is exactly
     * what happened here. BaseElementObject replaces 'Title' with a
     * TextCheckboxGroupField composite whose own name isn't a bare 'Title', so
     * insertAfter('Title', ...) used to fall through to CompositeField
     * recursion and nest the Year field inside it, where its two-child
     * template never rendered it -- Year was scaffolded correctly server-side
     * but invisible in the CMS. Assert Year is a direct, top-level field.
     */
    public function testYearFieldIsTopLevelNotNestedInTitleComposite()
    {
        $object = $this->objFromFixture(TimelineObject::class, 'milestone_one');
        $fieldset = $object->getCMSFields();

        $topLevelNames = [];
        foreach ($fieldset as $field) {
            $topLevelNames[] = $field->getName();
        }

        $this->assertContains('Year', $topLevelNames);
    }
}
