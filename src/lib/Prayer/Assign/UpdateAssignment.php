<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 3:53 PM
 */

namespace Prayer\Assign;

/**
 * Class UpdateAssignment
 * This handles loading a prayer assignment and updating its status
 *
 * @package Prayer\Assign
 */
class UpdateAssignment extends Assignment
{


    /**
     * Loads the prayer assignment and marks it complete
     * @param \User $agent
     * @param \User $patient
     * @param $date
     */
    public function markComplete(\User $agent, \User $patient, $date)
    {
        $this->load($agent, $patient, $date);
        $this->assign->setComplete(true)->save();
    }
}