<?php

/* studyarea.prayertask.active.twig */
class __TwigTemplate_d23252af47809c1be4de853ad4af49e0286aaf00eea165c2ef0f426c44df4270 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.prayertask.base.twig", "studyarea.prayertask.active.twig", 1);
        $this->blocks = array(
            'topInstructionPrayer' => array($this, 'block_topInstructionPrayer'),
            'mainContentPrayer' => array($this, 'block_mainContentPrayer'),
            'submissionControlsPrayer' => array($this, 'block_submissionControlsPrayer'),
            'bottomInstructionsPrayer' => array($this, 'block_bottomInstructionsPrayer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "studyarea.prayertask.base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_topInstructionPrayer($context, array $blocks = array())
    {
        // line 4
        echo "    <p class=\"instructionText\">Please complete the following prayer on behalf of your partner.</p>
    <p class=\"instructionText\">Please do not forget to click the \"Prayer completed\" button below. Once you do
    that, your partner will be notified that you have prayed for them.</p>
";
    }

    // line 9
    public function block_mainContentPrayer($context, array $blocks = array())
    {
        // line 10
        echo "        ";
        echo twig_escape_filter($this->env, (isset($context["mainContent"]) ? $context["mainContent"] : null), "html", null, true);
        echo "
";
    }

    // line 13
    public function block_submissionControlsPrayer($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->loadTemplate("studyarea.prayertask.base.prayersubmit.twig", "studyarea.prayertask.active.twig", 14)->display($context);
    }

    // line 17
    public function block_bottomInstructionsPrayer($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["bottomInstructions"]) ? $context["bottomInstructions"] : null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.active.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 18,  59 => 17,  54 => 14,  51 => 13,  44 => 10,  41 => 9,  34 => 4,  31 => 3,  11 => 1,);
    }
}
