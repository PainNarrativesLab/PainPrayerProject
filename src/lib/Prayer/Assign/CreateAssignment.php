<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 3:44 PM
 */

namespace Prayer\Assign;

/**
 * Class CreateAssignment
 *
 * This is the parent for the various classes which
 * create new prayer assignments
 *
 * @package Prayer\Assign
 */
class CreateAssignment extends Assignment
{

    public function create(\User $agent, \User $patient, $date)
    {
        $this->load($agent, $patient, $date);
    }


}