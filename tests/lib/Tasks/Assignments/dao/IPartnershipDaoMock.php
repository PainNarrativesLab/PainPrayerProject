<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 10:48 AM
 */

namespace Tasks\Assignments\dao;


class IPartnershipDaoMock extends \lib\MockParent implements \Tasks\Assignments\dao\IPartnershipDao
{

    public function loadAllForAgent(\User $agent)
    {
        $this->record_call(__FUNCTION__, array($agent));
        return $this->response;
    }

    public function loadByAgentAndDate(\User $agent, $date)
    {
        $this->record_call(__FUNCTION__, array($agent, $date));
        return $this->response;

    }

    public function loadByAgentAndPatient(\User $agent, \User $patient, $date)
    {
        $this->record_call(__FUNCTION__, array($agent, $patient));
        return $this->response;
    }

    public function loadByHash($assignmentHash)
    {
        $this->record_call(__FUNCTION__, array($assignmentHash));
        return $this->response;
    }

    public function createAssignment(\User $agent, \User $patient, $date, $hash)
    {
        $this->record_call(__FUNCTION__, array($agent, $patient, $date, $hash));
        return $this->response;

    }

    public function checkIfPatient(\User $user, $date)
    {
        $this->record_call(__FUNCTION__, array($user, $date));
        return $this->response;
    }

    public function checkIfAgent(\User $user, $date)
    {
        $this->record_call(__FUNCTION__, array($user, $date));
        return $this->response;
    }

    public function markComplete(\User $agent, \User $patient, $date)
    {
        $this->record_call(__FUNCTION__, array($agent, $patient, $date));
        return $this->response;

    }

    public function markCompleteByHash($assignmentHash)
    {
        $this->record_call(__FUNCTION__, array($assignmentHash));
        return $this->response;
    }
}