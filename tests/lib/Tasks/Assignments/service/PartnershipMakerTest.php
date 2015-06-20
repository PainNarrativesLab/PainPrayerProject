<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 10:46 AM
 */

namespace Tasks\Assignments\service;


class PartnershipMakerTest extends \PHPUnit_Framework_TestCase {

    protected $object;

    public function testCheckUnassigned()
    {
        $this->dao->setResponse(false);
        $this->object->setDao($this->dao);
        $result = $this->object->checkUnassigned(new \User(), new \User(), "2015-01-01");
        $this->assertTrue($result);
    }

    /**
     * @expectedException \Tasks\Assignments\errors\AlreadyAssignedException
     */
    public function testCheckUnassignedException()
    {
        $this->dao->setResponse(true);
        $this->object->setDao($this->dao);
        $result = $this->object->checkUnassigned(new \User(), new \User(), "2015-01-01");
    }

    public function testMake()
    {
        $testdate =  "2015-01-01";
        $testhash = sha1("catfood");
        $this->dao->setResponse(false);
        $this->object->setDao($this->dao);
        $this->hashMaker->setResponse($testhash);
        $this->object->setHashMaker($this->hashMaker);
        $this->object->make(new \User(), new \User(), $testdate);
        $this->assertEquals("createAssignment", $this->dao->called);
        $this->assertTrue(count($this->dao->called_list) === 3);
        $this->assertEquals("checkIfAgent", $this->dao->called_list[0][0]);
        $this->assertEquals("checkIfPatient", $this->dao->called_list[1][0]);
        $this->assertEquals("createAssignment", $this->dao->called_list[2][0]);

        $r = $this->dao->called_list[2][1];
        $this->assertInstanceOf('\User', $r[0]);
        $this->assertInstanceOf('\User', $r[1]);
        $this->assertEquals($testdate, $r[2]);
        $this->assertEquals($testhash, $r[3]);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PartnershipMaker;
        $this->dao = new \Tasks\Assignments\dao\IPartnershipDaoMock();
        $this->hashMaker = new \Tasks\Assignments\service\IHashMakerMock();
    }

    public function testSetDao()
    {
        $this->object->setDao($this->dao);
        $this->assertAttributeInstanceOf('\Tasks\Assignments\dao\IPartnershipDao', "dao", $this->object);
    }
    public function testSetHashMaker()
    {
        $this->object->setHashMaker($this->hashMaker);
        $this->assertAttributeInstanceOf('\Tasks\Assignments\service\IHashMaker', "hashMaker", $this->object);
    }

}

