<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/8/15
 * Time: 9:34 AM
 */

namespace TemplateClasses;


class LeftNav extends NavBar
{

    const TEMPLATE = "navbar.leftnav.twig";

    public function __construct()
    {
        parent::__construct();
    }

    public function output($loggedIn = false, $emailActivation = false)
    {

        $this->add_variables(array('loggedIn' => $loggedIn, 'emailActivation' => $emailActivation));
//        var_dump($this->variables);
        $this->render(self::TEMPLATE);

    }
}