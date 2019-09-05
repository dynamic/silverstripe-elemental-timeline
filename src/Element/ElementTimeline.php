<?php

namespace Dynamic\Elements\Timeline\Element;

use DNADesign\Elemental\Models\BaseElement;
use Dynamic\Elements\Timeline\Model\TimelineObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class ElementTimeline extends BaseElement
{
    /**
     * @return string
     */
    private static $singular_name = 'Timeline Element';

    /**
     * @return string
     */
    private static $plural_name = 'Timeline Elements';

    /**
     * @var array
     */
    private static $db = [
        'Content' => 'HTMLText',
    ];

    /**
     * @var string
     */
    private static $table_name = 'ElementTimeline';

    /**
     * @var array
     */
    private static $has_many = [
        'Milestones' => TimelineObject::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Milestones',
    ];

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->dataFieldByName('Content')
                ->setRows(5);

            if ($this->ID) {
                // Milestones
                $milestones = $fields->dataFieldByName('Milestones');
                $fields->removeByName('Milestones');
                $config = $milestones->getConfig();
                $config->addComponents([
                    new GridFieldOrderableRows('SortOrder'),
                ]);
                $config->removeComponentsByType([
                    GridFieldAddExistingAutocompleter::class,
                    GridFieldDeleteAction::class,
                ]);

                $fields->addFieldsToTab('Root.Main', array(
                    $milestones,
                ));
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return mixed
     */
    public function getMilestonesList()
    {
        return $this->Milestones()->sort('SortOrder');
    }

    /**
     * @return DBHTMLText
     */
    public function getSummary()
    {
        if ($this->Milestones()->count() == 1) {
            $label = ' milestone';
        } else {
            $label = ' milestones';
        }
        return DBField::create_field('HTMLText', $this->Milestones()->count() . $label)->Summary(20);
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__.'.BlockType', 'Timeline');
    }
}
