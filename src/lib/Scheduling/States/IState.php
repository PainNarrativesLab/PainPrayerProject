<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/26/15
 * Time: 12:38 PM
 */

namespace Scheduling\States;

/**
 * Interface IState
 * All possible partnership states implement this
 * @package Scheduling\States
 */
interface IState
{

    public function setAgent();

    public function setPatient();

}