<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 6:19 PM
 */

namespace Tasks\Assignments;


class PrayerAssignmentTest extends \PHPUnit_Framework_TestCase {

    protected $object; 
    
    protected function setUp()
    {
        parent::setUp();
        $this->object = new PrayerAssignment;
    }


    public function testMakeHash()
    {
//        $result = $this->object->makeHash();
//        var_dump($result);
//        $this->assertTrue(!empty($result));
    }

    public function testCreateAssignment()
    {
//        $date = "2015-01-01";
//        $users = \UserQuery::create()->find();
//        $this->object->createAssignment($users[0], $users[1], $date);
//
//        $result = \AssignedPrayerQuery::create()->filterByagent($users[0])->filterBypatient($users[1])->findOne();
//        $this->assertInstanceOf('\User', $result->getagent());
//        $this->assertInstanceOf('\User', $result->getpatient());
//        $this->assertInstanceOf('DateTime', $result->getPrayerDate());
//       // $this->assertEquals($date, $result->getPrayerDate());
//        $this->assertEquals(40, mb_strlen($result->getAssignmenthash()));
    }
}
