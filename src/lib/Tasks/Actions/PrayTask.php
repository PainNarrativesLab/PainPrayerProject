<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/17/15
 * Time: 5:31 PM
 */

namespace Tasks\Actions;


use Tasks\Assignment;

class PrayTask extends Assignment
{

    /** @var  $notifyPartner boolean */
    protected $notifyPartner;

    /**
     * The task or que of tasks to be executed
     * after the assignment has been recorded.
     */
    public function postRecordTask()
    {
        if($this->notifyPartner === true)
        {

        }
    }
}