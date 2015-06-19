<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 1:23 PM
 */

namespace Prayer\Display;


class PrayerGetter implements \Display\StudyArea\IContentMaker
{
    protected $trial;

    /**
     * @param mixed $trial
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;
    }

    public function make()
    {
        // TODO: Implement make() method.
    }

    public function getContent()
    {        $faker = \Faker\Factory::create();
        $text = $faker->paragraph(6);
        return array(\Display\StudyArea\PrayerTaskMaker::DATA_ARRAY_KEY => $text);
    }
}