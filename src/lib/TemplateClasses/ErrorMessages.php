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

    const UNDER_CONSTRUCTION = 'page.underconstruction.twig';

    public function __construct()
    {
        parent::__construct();
    }

    public function under_construction()
    {
        $this->render(self::UNDER_CONSTRUCTION);
    }
}