<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 5:07 PM
 */

namespace PainAssess\Display;


class PainAssessmentGetterTest extends \PHPUnit_Framework_TestCase {

    protected $object;
    protected $dao;
    protected $trial;

    protected function setUp()
    {
        $this->trial = new \Trial();
        $this->trial->setId(1);
    $this->dao = new \PainAssess\dao\IPainDaoMock();
        parent::setUp();
        $this->object = new PainAssessmentGetter;
    }


    public function testSetTrial()
    {
        $this->object->setTrial($this->trial);
        $this->assertAttributeInstanceOf('Trial', 'trial', $this->object);
    }

    public function testSetDao()
    {
        $this->object->setDao($this->dao);
        $this->assertAttributeInstanceOf('\PainAssess\dao\IPainDao', 'dao', $this->object);
    }

    public function testGetContent()
    {

        $this->object->setTrial($this->trial);
        $this->object->setDao($this->dao);
        $result = $this->object->getContent();
        $this->assertInstanceOf('array', $result);
        $this->assertArrayHasKey(\Display\StudyArea\PainRatingMaker::DATA_ARRAY_KEY, $result);
    }
}
