<?php

namespace Dynamic\Elements\Timeline\Model;

use Dynamic\BaseObject\Model\BaseElementObject;
use Dynamic\Elements\Timeline\Element\ElementTimeline;

class TimelineObject extends BaseElementObject
{
    /**
     * @return string
     */
    private static $singular_name = 'Milestone';

    /**
     * @return string
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
    private static $has_one = array(
        'ElementTimeline' => ElementTimeline::class,
    );

    /**
     * @var string
     */
    private static $table_name = 'TimelineObject';

    /**
     * @var string
     */
    private static $default_sort = 'SortOrder';

    /**
     * @return FieldList
     *
     * @throws \Exception
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->removeByName(array(
                'ElementTimelineID',
                'SortOrder',
            ));

            $fields->dataFieldByName('Image')
                ->setFolderName('Uploads/Elements/Timeline');

            $fields->insertAfter(
                'Title',
                $fields->dataFieldByName('Year')
                    ->setDescription('ex: 2010, or 2000s')
            );
        });

        return parent::getCMSFields();
    }
}
