<?php

/* footer.base.twig */
class __TwigTemplate_a0bc8117642e2589619cc28f9e2f74bdb6d032cf34783974d24aa7e09f483d25 extends Twig_Template
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
        echo "<div class=\"footer\">
    <hr/>
    <div id=\"footInfo\">
        <div class=\"footInfoArea\">Who we are</div>
        <div class=\"footInfoArea\">About the study</div>
        <div class=\"footInfoArea\">Disclosures</div>
        <div class=\"footInfoArea\">Contact</div>
    </div>
    <div id=\"copyrightArea\"> <p>&#169; Merp Co., Intl 2008-";
        // line 9
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "y"), "html", null, true);
        echo "</p></div>
    <div id=\"testLine\"> ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["testline"]) ? $context["testline"] : null), "html", null, true);
        echo " </div>
    <div id=\"editingArea\">";
        // line 11
        echo twig_escape_filter($this->env, (isset($context["editing"]) ? $context["editing"] : null), "html", null, true);
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "footer.base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 11,  33 => 10,  29 => 9,  19 => 1,);
    }
}
