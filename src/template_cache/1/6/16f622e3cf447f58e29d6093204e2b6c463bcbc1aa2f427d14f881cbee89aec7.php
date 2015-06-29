<?php

/* studyarea.prayertask.waitlist.agent.twig */
class __TwigTemplate_16f622e3cf447f58e29d6093204e2b6c463bcbc1aa2f427d14f881cbee89aec7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.prayertask.base.twig", "studyarea.prayertask.waitlist.agent.twig", 1);
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
        echo "    <p class=\"instructionText\">
        You are currently on the waitlist for a partner to be assigned to pray for you.
        In the meantime, if you would be willing to pray for someone else:
    </p>
    <br/>[which do we want]<br/>
    <ul>
        <li>who is not able or no available to pray for you</li>
        <li>whose partner is unable or unavailable to pray for them</li>
    </ul>
";
    }

    // line 15
    public function block_mainContentPrayer($context, array $blocks = array())
    {
        // line 16
        echo "        ";
        echo twig_escape_filter($this->env, (isset($context["mainContent"]) ? $context["mainContent"] : null), "html", null, true);
        echo "
";
    }

    // line 19
    public function block_submissionControlsPrayer($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        $this->loadTemplate("studyarea.prayertask.base.prayersubmit.twig", "studyarea.prayertask.waitlist.agent.twig", 20)->display($context);
    }

    // line 23
    public function block_bottomInstructionsPrayer($context, array $blocks = array())
    {
        // line 24
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["bottomInstructions"]) ? $context["bottomInstructions"] : null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.waitlist.agent.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 24,  65 => 23,  60 => 20,  57 => 19,  50 => 16,  47 => 15,  34 => 4,  31 => 3,  11 => 1,);
    }
}
