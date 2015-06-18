<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 3:11 PM
 */

namespace Display\StudyArea;


class PrayerTaskMaker extends StudyAreaMaker
{

    const DIV_ID = 'prayerTask';
    const TEMPLATE = 'studyarea.prayertask.twig';

    public function make()
    {
        $vars = array('mainContent' => $this->content_maker->make());
        $this->add_variables($vars);
        $this->setAreaDivId(self::DIV_ID);
        $this->render(self::TEMPLATE);
    }
}