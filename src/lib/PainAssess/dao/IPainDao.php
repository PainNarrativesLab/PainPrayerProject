<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 5:10 PM
 */

namespace PainAssess\dao;


interface IPainDao 
{


    public function getAllAssessmentItems();

    public function getAssessmentItemById($id);

    public function getAssessmentItemsByTrial($trial);
}