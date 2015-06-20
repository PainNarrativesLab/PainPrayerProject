<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 6:40 PM
 */

namespace PainAssess\dao;


class PainDao implements IPainDao
{


    public function getAllAssessmentItems()
    {
        return \PainAssessmentItemQuery::create()->find();
    }

    public function getAssessmentItemById($id)
    {
        return \PainAssessmentItemQuery::create()->filterById($id)->findOneOrCreate();
    }

    /**
     * Returns pain rating items associated with a particular trial.
     * Can take either a Trial object or integer trial id
     * @param $trial
     * @return \PainAssessmentItem[]|\Propel\Runtime\Collection\ObjectCollection
     * @throws \Exception
     */
    public function getAssessmentItemsByTrial($trial)
    {
        if($trial instanceof \Trial)
        {
            return \PainAssessmentItemQuery::create()->filterByTrial($trial)->find();
        }elseif(is_integer($trial)){
            $t = \TrialQuery::create()->filterById($trial)->findOne();
            return \PainAssessmentItemQuery::create()->filterByTrial($t)->find();
        }
        else{
            throw new \Exception("Invalid argument passed for trial");
        }
    }
}