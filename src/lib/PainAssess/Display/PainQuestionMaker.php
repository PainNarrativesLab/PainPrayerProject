<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 6:39 PM
 */

namespace PainAssess\Display;


class PainQuestionMaker 
{
    /** var $dao \PainAssess\dao\PainDao */
    protected $dao;


    public function make()
    {
        $items = $this->dao->getAllAssessmentItems();
    }
}