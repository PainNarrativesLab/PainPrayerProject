<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 5:11 PM
 */

namespace PainAssess\dao;


class IPainDaoMock extends \lib\MockParent implements \PainAssess\dao\IPainDao
{

    public function getAllAssessmentItems()
    {
        $this->record_call(__FUNCTION__, array());
        return $this->response;
    }

    public function getAssessmentItemById($id)
    {
        $this->record_call(__FUNCTION__, array($id));
        return $this->response;
     }

    public function getAssessmentItemsByTrial($trial)
    {
        $this->record_call(__FUNCTION__, array($trial));
        return $this->response;
    }
}