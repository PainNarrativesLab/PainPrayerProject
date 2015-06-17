<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/16/15
 * Time: 7:23 PM
 */

namespace TemplateClasses;


class PageMaker extends Controller
{
    const HEAD_TEMPLATE = 'base.html.head.twig';
    const FOOT_TEMPLATE = 'base.html.pagebottom.twig';

    protected $pageName;

    protected $bodyRenderer;

    protected $jsIncludes = array();

    /**
     * @param mixed $pageName
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
        $this->add_variables(array('page_title' => $pageName));
    }

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Makes the page head and opening main body divs
     */
    public function makePageTop()
    {
        $this->render(self::HEAD_TEMPLATE);
    }

    /**
     * Makes the closing div tags for the divs opened
     * by makePageTop, footer, and scriptbox
     * @param null $scripts
     * @param null $onload
     */
    public function makePageBottom($scripts = null, $onload = null)
    {
        if (!empty($scripts)) {
            $this->add_variables(array('scriptlist' => $scripts));
        }
        if(!empty($onload)){
            $this->add_variables(array('onload' => $onload));
        }
        $this->render(self::FOOT_TEMPLATE);
    }

}