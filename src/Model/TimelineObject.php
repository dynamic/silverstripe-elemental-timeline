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
     * Config merges additively across the class hierarchy (integer keys from
     * BaseElementObject's own $summary_fields append, they aren't reordered by this
     * override), so this only adds a Year column -- it doesn't reposition the two
     * inherited ones.
     */
    private static $summary_fields = [
        'Year' => 'Year',
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

            // Do not reposition with insertAfter('Title', ...): BaseElementObject replaces
            // 'Title' with a TextCheckboxGroupField whose own name is 'TitleShowTitle', so
            // FieldList's composite-recursion fallback nests the field inside that two-child
            // component, where it never renders. 'Image' is a real top-level field name (and
            // BaseElementObject anchors on it too, via insertBefore('Content', ...)), so it's
            // a safe anchor that degrades gracefully (appends instead of re-hiding) even if
            // that assumption ever breaks.
            $fields->insertBefore(
                'Image',
                $fields->dataFieldByName('Year')
                    ->setDescription('ex: 2010, or 2000s')
            );
        });

        return parent::getCMSFields();
    }
}
