<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 3:03 PM
 */

namespace Display\StudyArea;


class PainRatingMaker extends StudyAreaMaker
{
    const DIV_ID = 'painRating';

    const INPUT_ITEM_ID = 'itemId';

    const INPUT_ITEM_PROMPT = 'itemText';

    const DATA_ARRAY_KEY = 'assessmentItems';

    public function make()
    {
        $vars = $this->content_maker->getContent();
//        $vars = array('mainContent' => $this->content_maker->make());
        $this->add_variables($vars);
        $this->setAreaDivId(self::DIV_ID);
        $this->render(self::TEMPLATE_PAIN_RATINGS);

    }
}