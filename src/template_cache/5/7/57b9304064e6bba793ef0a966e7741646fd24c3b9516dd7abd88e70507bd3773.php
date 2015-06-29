<?php

/* error.linkexpired.twig */
class __TwigTemplate_57b9304064e6bba793ef0a966e7741646fd24c3b9516dd7abd88e70507bd3773 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "error.linkexpired.twig", 1);
        $this->blocks = array(
            'mainBody' => array($this, 'block_mainBody'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_mainBody($context, array $blocks = array())
    {
        // line 3
        echo "    <div class=\"errorMessage\">
        <p>It appears the link you used to get here expired.</p>
        <p>Please remember that the emailed links are only good for 24 hours.</p>
        <p>Please check your email for today's link. Make sure you check your spam or junk mail folder.</p>
        <p>If you cannot find today's link, please report the problem to us at [email link]</p>
    </div>
";
    }

    public function getTemplateName()
    {
        return "error.linkexpired.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 3,  28 => 2,  11 => 1,);
    }
}
