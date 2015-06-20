<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 6:39 PM
 */

namespace PainAssess\Display;


use Display\StudyArea\PainRatingMaker;

/**
 * Class PainAssessmentGetter
 *
 * Service class to package the assessment items into expected form
 *
 * @package PainAssess\Display
 */
class PainAssessmentGetter extends \TemplateClasses\Controller implements \Display\StudyArea\IContentMaker
{
    /** var $dao \PainAssess\dao\IPainDao */
    protected $dao;

    protected $trial;

    /**
     * @param mixed $trial
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;
    }

    /**
     * @param mixed $dao
     */
    public function setDao(\PainAssess\dao\IPainDao $dao)
    {
        $this->dao = $dao;
    }

    public function getContent()
    {
        $items = !empty($this->trial) ? $this->dao->getAssessmentItemsByTrial($this->trial) : $this->dao->getAllAssessmentItems();

        $vars = array();
        foreach($items as $it)
        {
            array_push($vars, array(
                PainRatingMaker::INPUT_ITEM_ID => $it->getId(),
                PainRatingMaker::INPUT_ITEM_PROMPT => $it->getText()
            ));
        }
        return array(PainRatingMaker::DATA_ARRAY_KEY => $vars);
    }

    public function make()
    {
    }
}