<?php

/* page.head_with_topbar.twig */
class __TwigTemplate_1001fea4a9346fc3baa365f1b1ece5f5657517d64b441a847396034f36f2d620 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.head.twig", "page.head_with_topbar.twig", 2);
        $this->blocks = array(
            'navArea' => array($this, 'block_navArea'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.head.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_navArea($context, array $blocks = array())
    {
        // line 4
        echo "<div id=\"topBar\">
    <div class=\"topBarItem\">
    <div id=\"timeline\" class=\"topBarItem\">Either a count of days involved or a graphic</div>
    <div id=\"logInDisplay\" class=\"topBarItem\">
        <div class=\"greeting\">Hello ";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
        echo "!</div>
        <div class=\"misIdentification\">Not ";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
        echo "? Click <input type=\"button\" id=\"login\" class=\"prettyButton\" value=\"here\" /> to log in </div>
    </div>
    </div>
    <div class=\"dividerLine\">
        <hr />
    </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "page.head_with_topbar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 9,  37 => 8,  31 => 4,  28 => 3,  11 => 2,);
    }
}
