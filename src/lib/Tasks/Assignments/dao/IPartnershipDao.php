<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 10:23 AM
 */

namespace Tasks\Assignments\dao;


interface IPartnershipDao 
{


    public function loadAllForAgent(\User $agent);


    public function loadByAgentAndDate(\User $agent, $date);

    /**
     * Loads and/or creates new prayer assignment in db and stores object in $this->assign
     * @param \User $agent
     * @param \User $patient
     * @param $date
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function loadByAgentAndPatient(\User $agent, \User $patient, $date);


    public function loadByHash($assignmentHash);

    public function createAssignment(\User $agent, \User $patient, $date, $hash);


    /**
     * Looks up whether the person is assigned as a patient
     * on the given date.
     * @param $user
     * @param $date
     * @return bool
     */
    public function checkIfPatient(\User $user, $date);


    /**
     * Looks up whether the person is assigned as agent
     * on the given date.
     * @param $user
     * @param $date
     * @return bool
     */
    public function checkIfAgent(\User $user, $date);


    /**
     * Loads the prayer assignment and marks it complete
     * @param \User $agent
     * @param \User $patient
     * @param $date
     */
    public function markComplete(\User $agent, \User $patient, $date);

    public function markCompleteByHash($assignmentHash);

}