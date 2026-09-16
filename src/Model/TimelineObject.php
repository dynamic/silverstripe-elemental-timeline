<?php

namespace Dynamic\Elements\Timeline\Model;

use Dynamic\BaseObject\Model\BaseElementObject;
use Dynamic\Elements\Timeline\Element\ElementTimeline;
use SilverStripe\Forms\FieldList;

/**
 * @method ElementTimeline ElementTimeline()
 */
class TimelineObject extends BaseElementObject
{
    /**
     * @var string
     */
    private static $singular_name = 'Milestone';

    /**
     * @var string
     */
    private static $plural_name = 'Milestones';

    /**
     * @var array
     */
    private static $db = [
        'Year' => 'Varchar(10)',
        'SortOrder' => 'Int',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'ElementTimeline' => ElementTimeline::class,
    ];

    /**
     * @var string
     */
    private static $table_name = 'TimelineObject';

    /**
     * @var string
     */
    private static $default_sort = 'SortOrder';

    /**
     * @var array
     */
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Year' => 'Year',
        'Title' => 'Title',
    ];

    /**
     * @return FieldList
     *
     * @throws \Exception
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->removeByName([
                'ElementTimelineID',
                'SortOrder',
            ]);

            $fields->dataFieldByName('Image')
                ->setFolderName('Uploads/Elements/Timeline');

            // Note: this field is intentionally left in its natural scaffolded position
            // rather than moved with insertAfter('Title', ...). BaseElementObject replaces
            // 'Title' with a TextCheckboxGroupField composite (Title input + Displayed
            // checkbox) that reports its own name as a concatenation of its children's
            // names, not 'Title'. FieldList::insertAfter()'s exact-name match at the top
            // level then fails and falls through to its CompositeField-recursion branch,
            // which finds the nested 'Title' child inside that composite and splices this
            // field in there instead -- as a third, unexpected child of a component built
            // for exactly two. The composite's own template only renders its two known
            // children, so the inserted field silently disappears from the CMS entirely
            // (while still present in the underlying FieldList, which is why this was hard
            // to spot: DataObject::getCMSFields() and FieldList::dataFieldByName() both
            // still report it as present). Confirmed live: this is why editors could not
            // set a Milestone's Year at all, from either a new or an existing record.
            $fields->dataFieldByName('Year')
                ->setDescription('ex: 2010, or 2000s');
        });

        return parent::getCMSFields();
    }
}
