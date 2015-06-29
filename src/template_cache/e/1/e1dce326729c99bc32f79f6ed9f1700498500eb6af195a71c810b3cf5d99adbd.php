<?php

/* js.jqueryCss.twig */
class __TwigTemplate_e1dce326729c99bc32f79f6ed9f1700498500eb6af195a71c810b3cf5d99adbd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((isset($context["jquery_theme"]) ? $context["jquery_theme"] : null)) {
            // line 2
            echo "    <link rel=\"stylesheet\"
          href=\"http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/";
            // line 3
            echo twig_escape_filter($this->env, (isset($context["jquery_theme"]) ? $context["jquery_theme"] : null), "html", null, true);
            echo "/jquery-ui.css\">';
";
        } else {
            // line 5
            echo "    <link rel=\"stylesheet\" href=\"http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/overcast/jquery-ui.css\">
";
        }
    }

    public function getTemplateName()
    {
        return "js.jqueryCss.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 5,  24 => 3,  21 => 2,  19 => 1,);
    }
}
