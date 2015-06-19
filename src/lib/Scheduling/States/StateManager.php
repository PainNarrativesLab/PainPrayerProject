<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 4:03 PM
 */

namespace Scheduling\States;


class StateManager 
{

    const PRE_EXPERIMENT = 100;

    const WAITLIST_AGENT = 101;

    const WAITLIST_PATIENT = 102;

    const ACTIVE = 103;

    const POST_EXPERIMENT = 104;

    const END = 105;

    public function loadState(){}
}