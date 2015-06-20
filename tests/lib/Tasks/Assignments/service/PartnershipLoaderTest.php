<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 10:46 AM
 */

namespace Tasks\Assignments\service;


use Tasks\Assignments\service\PartnershipLoader;

class PartnershipLoaderTest extends \PHPUnit_Framework_TestCase
{

    protected $object;
    protected $dao;

    public function testCheckIfHash()
    {
        $testhash = sha1("catfood");
        $this->assertTrue($this->object->checkIfHash($testhash));

        $this->assertFalse($this->object->checkIfHash(45));
        $this->assertFalse($this->object->checkIfHash(new \User()));
        $this->assertFalse($this->object->checkIfHash());

        $this->assertFalse($this->object->checkIfHash($testhash . $testhash));
    }

    public function testCheckIfUser()
    {
        $testhash = sha1("catfood");
        $this->assertTrue($this->object->checkIfUser(new \User()));
        $this->assertFalse($this->object->checkIfUser(43));
        $this->assertFalse($this->object->checkIfUser());
        $this->assertFalse($this->object->checkIfUser($testhash));
    }

    public function testChooseMethodUser()
    {
        $this->object->chooseMethod(new \User());
        $this->assertAttributeEquals(PartnershipLoader::IDENTIFIER_USER, "type", $this->object);
    }

    public function testChooseMethodHash()
    {
        $this->object->chooseMethod(sha1("catfood"));
        $this->assertAttributeEquals(PartnershipLoader::IDENTIFIER_HASH, "type", $this->object);
    }

    /**
     * @expectedException \Exception
     */
    public function testChooseMethodException()
    {
        $bad_inputs = array(45, '', 'catfood');
        foreach($bad_inputs as $b){
            $this->object->chooseMethod($b);
        }
    }

    public function testLoadUser()
    {
        $this->dao->setResponse(new \AssignedPrayer());
        $this->object->setDao($this->dao);
        $this->object->load(new \User(), "2015-01-01");
        $this->assertNotEmpty($this->object->partnership);
        $this->assertAttributeEquals(PartnershipLoader::IDENTIFIER_USER, "type", $this->object);
        $this->assertAttributeInstanceOf('\AssignedPrayer', "partnership", $this->object);
    }

    public function testLoadHash()
    {
        $this->dao->setResponse(new \AssignedPrayer());
        $this->object->setDao($this->dao);
        $this->object->load(sha1("catfood"));
        $this->assertNotEmpty($this->object->partnership);
        $this->assertAttributeEquals(PartnershipLoader::IDENTIFIER_HASH, "type", $this->object);
        $this->assertAttributeInstanceOf('\AssignedPrayer', "partnership", $this->object);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PartnershipLoader;
        $this->dao = new \Tasks\Assignments\dao\IPartnershipDaoMock();
    }

    public function testSetDao()
    {
        $this->object->setDao($this->dao);
        $this->assertAttributeInstanceOf('\Tasks\Assignments\dao\IPartnershipDao', "dao", $this->object);
    }


}
