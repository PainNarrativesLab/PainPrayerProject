<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 3:30 PM
 */

namespace Display\StudyArea;


class IContentMakerMock implements \Display\StudyArea\IContentMaker
{

    public function make()
    {
        $faker = \Faker\Factory::create();
        $content = $faker->paragraph(6);
        return $content;
     }

    public function getContent()
    {
        // TODO: Implement getContent() method.
    }
}