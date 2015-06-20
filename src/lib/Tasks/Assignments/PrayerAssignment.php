<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 5:46 PM
 */

namespace Tasks\Assignments;


use Tasks\Assignment;

class PrayerAssignment extends Assignment
{



    /**
     * The task or que of tasks to be executed
     * after the assignment has been recorded.
     */
    public function postRecordTask()
    {
        // TODO: Implement postRecordTask() method.
    }

    public function createAssignment($agent, $patient, $date)
    {
        $assign = new \AssignedPrayer();
        $assign->setagent($agent);
        $assign->setpatient($patient);
        $assign->setPrayerDate($date);
        $assign->setAssignmenthash($this->makeHash());
        $assign->save();
    }

    /**
     * Makes sure that the patient is not already assigned to someone else
     * @param $patient
     */
    public function checkPatientUnassigned($patient)
    {}

    public function makeHash()
    {
        $i = 0;
        while(FALSE || $i != self::MAX_TRIES){
            $candidate = sha1(\openssl_random_pseudo_bytes(self::LOOKUP_SIZE));
//        $candidate = sha1(\openssl_random_pseudo_bytes(self::LOOKUP_SIZE));
            if (empty(\AssignedPrayerQuery::create()->filterByAssignmenthash($candidate)->findOne())) {
                return $candidate;
            }
            else{
                $i++;
            }
        }
    }
}