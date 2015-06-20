<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:24 AM
 */

namespace Tasks\Assignments\dao;


class PartnershipDao
{

    public function loadAllForAgent(\User $agent)
    {

    }

    public function loadByAgentAndDate(\User $agent, $date)
    {

    }

        /**
     * Loads and/or creates new prayer assignment in db and stores object in $this->assign
     * @param \User $agent
     * @param \User $patient
     * @param $date
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function loadByAgentAndPatient(\User $agent, \User $patient, $date)
    {
        $assign = \AssignedPrayerQuery::create()
            ->filterByagent($agent)
            ->filterBypatient($patient)
            ->filterByPrayerDate($date)
            ->findOneOrCreate();
    }

    public function loadByHash($assignmentHash)
    {
        return \AssignedPrayerQuery::create()
            ->filterByAssignmenthash($assignmentHash)
            ->findOne();
    }

    public function createAssignment(\User $agent, \User $patient, $date, $hash)
    {
        $assign = new \AssignedPrayer();
        $assign->setagent($agent);
        $assign->setpatient($patient);
        $assign->setPrayerDate($date);
        $assign->setAssignmenthash($hash);
        $assign->save();
        return $assign;
    }

    /**
     * Looks up whether the person is assigned as a patient
     * on the given date.
     * @param $user
     * @param $date
     * @return bool
     */
    public function checkIfPatient(\User $user, $date)
    {
        $result = \AssignedPrayerQuery::create()
            ->filterByPrayerDate($date)
            ->filterBypatient($user)
            ->findOne();
        return empty($result) ? false : true;
    }

    /**
     * Looks up whether the person is assigned as agent
     * on the given date.
     * @param $user
     * @param $date
     * @return bool
     */
    public function checkIfAgent(\User $user, $date)
    {
        $result = \AssignedPrayerQuery::create()
            ->filterByPrayerDate($date)
            ->filterByagent($user)
            ->findOne();
        return empty($result) ? false : true;
    }

    /**
     * Loads the prayer assignment and marks it complete
     * @param \User $agent
     * @param \User $patient
     * @param $date
     */
    public function markComplete(\User $agent, \User $patient, $date)
    {
        $assign = $this->loadByAgentAndPatient($agent, $patient, $date);
        $assign->setComplete(true)->save();
    }

    public function markCompleteByHash($assignmentHash)
    {
        $assign = $this->loadByHash($assignmentHash);
        $assign->setComplete(true)->save();
    }
}