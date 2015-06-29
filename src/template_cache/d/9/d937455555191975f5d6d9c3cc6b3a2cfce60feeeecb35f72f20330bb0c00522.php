<?php

/* studyarea.prayertask.preexperiment.twig */
class __TwigTemplate_d937455555191975f5d6d9c3cc6b3a2cfce60feeeecb35f72f20330bb0c00522 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.prayertask.base.twig", "studyarea.prayertask.preexperiment.twig", 1);
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

    // line 4
    public function block_topInstructionPrayer($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->loadTemplate("studyarea.prayertask.base.noprayer.twig", "studyarea.prayertask.preexperiment.twig", 5)->display($context);
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.preexperiment.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 5,  28 => 4,  11 => 1,);
    }
}
