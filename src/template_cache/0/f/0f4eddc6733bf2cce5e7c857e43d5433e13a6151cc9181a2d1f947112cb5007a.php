<?php

/* studyarea.prayertask.waitlist.patient.twig */
class __TwigTemplate_0f4eddc6733bf2cce5e7c857e43d5433e13a6151cc9181a2d1f947112cb5007a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.prayertask.base.twig", "studyarea.prayertask.waitlist.patient.twig", 1);
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
        You are currently on the waitlist for a partner to be assigned. Please continue filling out the pain
        questionnaires.
    </p>
    <p class=\"instructionText\">
        Thank you for your patience! And, thank you again for your participation
    </p>
    <p class=\"instructionText\">
        [Or should we just keep the pre experimental message. People might get discouraged and stop checking in if they
        think they are on a waitlist...]
    </p>
";
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.waitlist.patient.twig";
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
