<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 4:29 PM
 */

namespace Prayer\Assign;


//use Symfony\Component\Validator\Constraints\DateTime;

class CreateAssignmentTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new CreateAssignment();
        $users = \UserQuery::create()->find();
        $this->agent = $users[0];
//        $this->agent->setId(2);
        $this->patient = $users[1]; //new \User();
//        $this->patient->setId(3);
        $faker = \Faker\Factory::create();
        $this->date = $faker->dateTime();
    }

    /**
     * @covers \Prayer\Assign\CreateAssignment::create
     */
    public function testCreate()
    {

        $this->object->create($this->agent, $this->patient, $this->date);
        $result = \AssignedPrayerQuery::create()
            ->filterByagent($this->agent)
            ->filterBypatient($this->patient)
            ->filterByPrayerDate($this->date)->findOne();
        $this->assertTrue($result);
    }
}
