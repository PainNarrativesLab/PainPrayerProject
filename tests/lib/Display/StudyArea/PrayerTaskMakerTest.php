<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 5:42 PM
 */

namespace Display\StudyArea;


use \Display\StudyArea\StudyAreaMaker;
use \Scheduling\States\StateManager;

class PrayerTaskMakerTest extends \PHPUnit_Framework_TestCase {

    protected $object;
    protected $stages;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PrayerTaskMaker;
        $this->stages = [
            array('PRE_EXPERIMENT', StateManager::PRE_EXPERIMENT, StudyAreaMaker::TEMPLATE_PRE_EXPERIMENT),
            array('WAITLIST-agent', StateManager::WAITLIST_AGENT, StudyAreaMaker::TEMPLATE_WAITLIST_AGENT),
            array('WAITLIST-patient', StateManager::WAITLIST_PATIENT, StudyAreaMaker::TEMPLATE_WAITLIST_PATIENT),
            array('ACTIVE', StateManager::ACTIVE, StudyAreaMaker::TEMPLATE_ACTIVE),
            array('POST_EXPERIMENT', StateManager::POST_EXPERIMENT, StudyAreaMaker::TEMPLATE_POST_EXPERIMENT),
            array('END', StateManager::END, StudyAreaMaker::TEMPLATE_END)
        ];
    }

    public function testChooseTemplate()
    {

        foreach ($this->stages as $s) {
            $this->object->chooseTemplate($s[1]);
            $this->assertAttributeEquals($s[2], 'template', $this->object, "error with " . $s[0]);
//            $this->assertAttributeInstanceOf($s[1], 'template', $this->object, "error with " . $s[0]);
        }


    }

}
