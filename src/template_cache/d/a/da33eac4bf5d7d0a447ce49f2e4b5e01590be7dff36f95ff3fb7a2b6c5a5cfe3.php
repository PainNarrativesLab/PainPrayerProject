<?php

/* studyarea.painquestions.twig */
class __TwigTemplate_da33eac4bf5d7d0a447ce49f2e4b5e01590be7dff36f95ff3fb7a2b6c5a5cfe3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.base.twig", "studyarea.painquestions.twig", 1);
        $this->blocks = array(
            'areaTitle' => array($this, 'block_areaTitle'),
            'topInstruction' => array($this, 'block_topInstruction'),
            'mainContent' => array($this, 'block_mainContent'),
            'submissionControls' => array($this, 'block_submissionControls'),
            'bottomInstructions' => array($this, 'block_bottomInstructions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "studyarea.base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_areaTitle($context, array $blocks = array())
    {
        // line 4
        echo "     Record pain
 ";
    }

    // line 7
    public function block_topInstruction($context, array $blocks = array())
    {
        // line 8
        echo "    Please rate the pain you are experiencing today
";
    }

    // line 11
    public function block_mainContent($context, array $blocks = array())
    {
        // line 12
        echo twig_escape_filter($this->env, (isset($context["mainContent"]) ? $context["mainContent"] : null), "html", null, true);
        echo "
";
    }

    // line 15
    public function block_submissionControls($context, array $blocks = array())
    {
    }

    // line 18
    public function block_bottomInstructions($context, array $blocks = array())
    {
        // line 19
        echo "    <div class=\"bottomInstructions\">Once you have completed the above pain questionnaire, please follow the instructions which will appear below.</div>
";
    }

    public function getTemplateName()
    {
        return "studyarea.painquestions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 19,  62 => 18,  57 => 15,  51 => 12,  48 => 11,  43 => 8,  40 => 7,  35 => 4,  32 => 3,  11 => 1,);
    }
}
