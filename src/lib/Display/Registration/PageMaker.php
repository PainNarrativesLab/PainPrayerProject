<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/29/15
 * Time: 1:10 PM
 */

namespace Display\Registration;


use \TemplateClasses\Controller;


class PageMaker extends Controller
{

    const  TEMPLATE_BASE = "registration.base.twig";

    public $ages = array();

    public $races = array('race1', 'race2', "race3");

    public $ethnicities = array("ethnicity1", "ethnicity2");

    public function __construct()
    {
        parent::__construct();
    }

    public function getValues()
    {
        //= array("18-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80", "81-90", "90+")
        $ages = \AgeQuery::create()->find();
        foreach($ages as $a)
        {
            array_push($this->ages, $a->getAge());
        }
    }

    public function setNonce($nonce)
    {
        $this->add_variables(array("nonce"=> $nonce));
    }

    /**
     * Possible template values include:
     * "registrationInstructions" => $fake->paragraph(),
     * "informedConsentText" => "informed consent " . $fake->paragraph());
     */
    public function make()
    {
        $fake = \Faker\Factory::create();
        $vars = array(
            "userAges" => $this->ages,
            "userRaces"=> $this->races,
            "userEthnicities" => $this->ethnicities
        );
        $this->add_variables($vars);
        $this->render(self::TEMPLATE_BASE);
    }
}