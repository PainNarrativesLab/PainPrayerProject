<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 3:49 PM
 */

namespace Prayer\Assign;

/**
 * Class Assignment
 *
 * This is the parent for the various classes which
 * handle assigning and managing a prayer task
 *
 * @package Prayer\Assign
 */
abstract class Assignment
{

    /** @var  $agent \User The person who prays */
    protected $agent;

    /** @var  $patient \User The person who is prayed for */
    protected $patient;

    /** @var  $complete Boolean Whether the prayer has been done */
    protected $complete;

    /** @var  $date Date of the prayer assignment */
    protected $date;

    /** @var  $assign \AssignedPrayer AssignedPrayer ORM object */
    public $assign;

    /**
     * Setter for agent (person praying)
     * @param \User $user
     */
    public function setAgent(\User $user)
    {
        $this->agent = $user;
    }

    /**
     * Setter for patient (person being prayed for)
     * @param \User $user
     */
    public function setPatient(\User $user)
    {
        $this->patient = $user;
    }

    /**
     * Loads and/or creates new prayer assignment in db and stores object in $this->assign
     * @param \User $agent
     * @param \User $patient
     * @param $date
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function load(\User $agent, \User $patient, $date)
    {
        $this->agent = $agent;
        $this->patient = $patient;
        $this->assign = \AssignedPrayerQuery::create()
            ->filterByagent($this->agent)
            ->filterBypatient($this->patient)
            ->filterByPrayerDate($date)
            ->findOneOrCreate();
    }


}