<?php

/* js.jquery.twig */
class __TwigTemplate_839063eab126085a25a0abdb8901393920dc6be9a3282c3a69e0859252420b08 extends Twig_Template
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
        if (((isset($context["local"]) ? $context["local"] : null) == true)) {
            // line 2
            echo "    <link rel=\"stylesheet\" href=\"inc/js/local_jquery/jquery.ui.custom.min.css\">
    <script type=\"text/javascript\" src=\"inc/js/local_jquery/jquery.min.js\"></script>
    <script type=\"text/javascript\" src=\"inc/js/local_jquery/jquery.ui.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"inc/js/local_jquery/jquery.tmpl.min.js\"></script>
    <script type=\"text/javascript\" src=\"inc/js/touchpunch.js\"></script>
";
        } else {
            // line 8
            echo "
    ";
            // line 9
            if (((isset($context["full"]) ? $context["full"] : null) == true)) {
                // line 10
                echo "        <script type=\"text/javascript\" src=\"http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.js\"></script>
        <script type=\"text/javascript\" src=\"http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.js\"></script>
        <script type=\"text/javascript\"
                src=\"http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js\"></script>
        <script type=\"text/javascript\" src=\"inc/js/touchpunch.js\"></script>
    ";
            } else {
                // line 16
                echo "        <script type=\"text/javascript\" src=\"http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js\"></script>
        <script type=\"text/javascript\" src=\"http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js\"></script>
        <script type=\"text/javascript\"
                src=\"http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js\"></script>
        <script type=\"text/javascript\" src=\"js/touchpunch.js\"></script>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "js.jquery.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 16,  34 => 10,  32 => 9,  29 => 8,  21 => 2,  19 => 1,);
    }
}
