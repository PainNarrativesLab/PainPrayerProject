<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 6:40 PM
 */

namespace PainAssess\dao;


class PainDao 
{


    public function getAllAssessmentItems()
    {
        return \PainAssessmentItemQuery::create()->find();
    }

    public function getAssessmentItemById($id)
    {
        return \PainAssessmentItemQuery::create()->filterById($id)->findOneOrCreate();
    }
}