<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/8/15
 * Time: 12:45 PM
 */

namespace TemplateClasses;


class ErrorMessages extends Controller
{

    const UNDER_CONSTRUCTION = 'error.underconstruction.twig';
    const LINK_EXPIRED = "error.linkexpired.twig";

    public function __construct()
    {
        parent::__construct();
    }

    public function under_construction()
    {
        $this->render(self::UNDER_CONSTRUCTION);
    }

    public function link_expired()
    {
        $this->render(self::LINK_EXPIRED);
    }
}