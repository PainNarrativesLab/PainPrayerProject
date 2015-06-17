<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/16/15
 * Time: 7:23 PM
 */

namespace TemplateClasses;


class PageBodyMaker extends Controller
{
    protected $pageName;

    protected $bodyRenderer;

    protected $jsIncludes = array();

    /**
     * @param mixed $pageName
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
    }

public function __construct()
{
    parent::__construct();
}


}