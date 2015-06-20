<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:27 AM
 */

namespace Tasks\Assignments\dao;


class PartnershipDaoTest extends \PHPUnit_Framework_TestCase {

    protected $object;
    protected $users;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PartnershipDao;
        $this->users = \UserQuery::create()->find();
    }

    public function testCreateAssignment()
    {
        $date = "2015-01-01";
        $users = \UserQuery::create()->find();
        $this->object->createAssignment($users[0], $users[1], $date, sha1("teststring"));

        $result = \AssignedPrayerQuery::create()->filterByagent($users[0])->filterBypatient($users[1])->findOne();
        $this->assertInstanceOf('\User', $result->getagent());
        $this->assertInstanceOf('\User', $result->getpatient());
        $this->assertInstanceOf('DateTime', $result->getPrayerDate());
        // $this->assertEquals($date, $result->getPrayerDate());
        $this->assertEquals(40, mb_strlen($result->getAssignmenthash()));
    }


    public function loadAllForAgent()
    {

    }

    public function testLoadByAgentAndDate()
    {
//        \User $agent, $date
    }

    public function testLoadByAgentAndPatient()
    {
//        \User $agent, \User $patient, $date)
//        $assign = \AssignedPrayerQuery::create()
//            ->filterByagent($agent)
//            ->filterBypatient($patient)
//            ->filterByPrayerDate($date)
//            ->findOneOrCreate();
    }

    public function testLoadByHash()
    {
//        $assign = \AssignedPrayerQuery::create()
//            ->filterByAssignmenthash($assignmentHash)
//            ->findOne();
    }


    public function testMarkComplete()
    {
//        \User $agent, \User $patient, $date)
//        $assign = $this->loadByAgentAndPatient($agent, $patient, $date);
//        $assign->setComplete(true)->save();
    }

    public function testMarkCompleteByHash()
    {}
}
