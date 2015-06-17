<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/24/15
 * Time: 4:29 PM
 */

namespace Scheduling;


use Scheduling\Scheduler;

class SchedulerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->object = new Scheduler();
        parent::setUp();
    }

    public function test()
    {
        $this->assertTrue(true);

    }
}
