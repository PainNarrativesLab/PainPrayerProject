<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/29/15
 * Time: 1:27 PM
 */

namespace Display\Registration;


class ParticipantInfoMaker extends PageMaker
{

    public function make()
    {
        $fake = \Faker\Factory::create();
        $vars = array("registrationInstructions" => $fake->paragraph(),
            "informedConsentText" => "informed consent " . $fake->paragraph());
        $this->add_variables($vars);
        $this->render(self::TEMPLATE_BASE);
        // TODO: Implement make() method.
    }
}