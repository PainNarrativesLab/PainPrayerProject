<?php

/* studyarea.prayertask.postexperiment.twig */
class __TwigTemplate_d42d4d1fa404cfdef2904917bb397d74b7167fe49d5c909b185490c916840d8a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.prayertask.base.twig", "studyarea.prayertask.postexperiment.twig", 1);
        $this->blocks = array(
            'topInstructionPrayer' => array($this, 'block_topInstructionPrayer'),
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
        echo "    <p class=\"instructionText\">
        The experimental phase of the study has been completed. However, we now need you to stop praying for your
        partner for a couple of weeks. During this time please continue to fill out the pain questionnaire.
    </p>
    <p class=\"instructionText\">
        After this final phase if complete, you may pray or not pray for your partner as much as you wish.
    </p>
";
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.postexperiment.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
