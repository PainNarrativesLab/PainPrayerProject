<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:51 AM
 */

namespace Tasks\Assignments\service;


class PartnershipMaker
{

    protected $dao;

    /**
     * @param mixed $dao
     */
    public function setDao($dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param mixed $hashMaker
     */
    public function setHashMaker($hashMaker)
    {
        $this->hashMaker = $hashMaker;
    }

    protected $hashMaker;

    /**
     * Creates a prayer assignment for the agent and patient on the
     * specified date.
     *
     * @param $agent
     * @param $patient
     * @param $date
     * @throws \Tasks\Assignments\errors\AlreadyAssignedException
     */
    public function make($agent, $patient, $date)
    {
        if($this->checkUnassigned($agent, $patient, $date))
        {
            $hash = $this->hashMaker->makeHash();
            if($hash)
            {
                $this->dao->createAssignment($agent, $patient, $date, $hash);
            }
        }
    }

    /**
     * Makes sure that the users are not already assigned to someone else
     * @param $agent
     * @param $patient
     * @param $date
     * @return bool
     * @throws \Tasks\Assignments\errors\AlreadyAssignedException
     */
    public function checkUnassigned($agent, $patient, $date)
    {
        if ($this->dao->checkIfAgent($agent, $date)) {
            throw new \Tasks\Assignments\errors\AlreadyAssignedException();
            //\Exceptions\AlreadyAssignedException();
        }
        if ($this->dao->checkIfPatient($patient, $date))
        {
            throw new \Tasks\Assignments\errors\AlreadyAssignedException();
//            throw new \Exceptions\AlreadyAssignedException();
        }
        return true;
    }
}