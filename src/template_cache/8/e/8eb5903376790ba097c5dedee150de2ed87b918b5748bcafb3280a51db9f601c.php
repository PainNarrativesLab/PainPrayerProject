<?php

/* base.html.twig */
class __TwigTemplate_8eb5903376790ba097c5dedee150de2ed87b918b5748bcafb3280a51db9f601c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'mainBody' => array($this, 'block_mainBody'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("page.base.head.twig", "base.html.twig", 1)->display($context);
        // line 2
        echo "    ";
        $this->displayBlock('mainBody', $context, $blocks);
        // line 4
        $this->loadTemplate("page.base.pagebottom.twig", "base.html.twig", 4)->display($context);
        // line 5
        echo "

    ";
        // line 8
        echo "        ";
        // line 9
        echo "            ";
        // line 10
        echo "        ";
        // line 11
        echo "    ";
        // line 14
        echo "    ";
        // line 15
        echo "
    ";
        // line 17
        echo "
    ";
        // line 19
        echo "    ";
    }

    // line 2
    public function block_mainBody($context, array $blocks = array())
    {
        // line 3
        echo "    ";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 3,  51 => 2,  47 => 19,  44 => 17,  41 => 15,  39 => 14,  37 => 11,  35 => 10,  33 => 9,  31 => 8,  27 => 5,  25 => 4,  22 => 2,  20 => 1,);
    }
}
