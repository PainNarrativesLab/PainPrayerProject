<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/17/15
 * Time: 5:32 PM
 */

namespace Tasks;


abstract class Assignment
{

    protected $id;

    protected $startDate;

    protected $endDate;

    /** @var  \User */
    protected $agent;

    /** @var  \User */
    protected $patient;

    /** @var  $action \Tasks\Actions\Action */
    protected $action;

    /**
     * The task or que of tasks to be executed
     * after the assignment has been recorded.
     */
    abstract public function postRecordTask();
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \User
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param \User $agent
     */
    public function setAgent(\User $agent)
    {
        $this->agent = $agent;
    }

    /**
     * @return \User
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param \User $patient
     */
    public function setPatient(\User $patient)
    {
        $this->patient = $patient;
    }

    /**
     * @return Actions\Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Actions\Action $action
     */
    public function setAction(\Tasks\Actions\Action $action)
    {
        $this->action = $action;
    }


}