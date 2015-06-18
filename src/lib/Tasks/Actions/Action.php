<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/17/15
 * Time: 5:23 PM
 */

namespace Tasks\Actions;


abstract class Action
{

    protected $agentInstruction;

    protected $patientInstruction;

    /**
     * @param mixed $agentInstruction
     */
    public function setAgentInstruction(\Tasks\Actions\Instruction $agentInstruction)
    {
        $this->agentInstruction = $agentInstruction;
    }

    /**
     * @param mixed $patientInstruction
     */
    public function setPatientInstruction(\Tasks\Actions\Instruction $patientInstruction)
    {
        $this->patientInstruction = $patientInstruction;
    }

    public function getAgentMessageContent()
    {
        $this->agentInstruction->getText();
    }

    public function getPatientMessageContent()
    {
        $this->patientInstruction->getText();
    }

}