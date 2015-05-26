<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 12:28 PM
 */

namespace Scheduling;

/**
 * Interface ITask
 * This is implemented by any task that must
 * be run on a schedule.
 * @package Scheduling
 */
interface ITask
{

    /**
     * Run the task
     * @return mixed
     */
    public function run();

    /**
     * Returns true if task successfully ran
     * and false otherwise
     * @return boolean
     */
    public function checkRan();
}