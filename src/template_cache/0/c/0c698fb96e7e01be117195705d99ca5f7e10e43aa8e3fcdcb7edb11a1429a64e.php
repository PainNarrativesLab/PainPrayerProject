<?php

/* studyarea.base.twig */
class __TwigTemplate_0c698fb96e7e01be117195705d99ca5f7e10e43aa8e3fcdcb7edb11a1429a64e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'areaTitle' => array($this, 'block_areaTitle'),
            'topInstruction' => array($this, 'block_topInstruction'),
            'mainContent' => array($this, 'block_mainContent'),
            'submissionControls' => array($this, 'block_submissionControls'),
            'bottomInstructions' => array($this, 'block_bottomInstructions'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"";
        echo twig_escape_filter($this->env, (isset($context["studyAreaId"]) ? $context["studyAreaId"] : null), "html", null, true);
        echo "\" class=\"studyArea\">
    <div class=\"areaTitle studyAreaItem\">
        ";
        // line 3
        $this->displayBlock('areaTitle', $context, $blocks);
        // line 5
        echo "    </div>

    <div class=\"topInstructions studyAreaItem\">
        ";
        // line 8
        $this->displayBlock('topInstruction', $context, $blocks);
        // line 10
        echo "    </div>

    <div class=\"mainContent studyAreaItem\">
        ";
        // line 13
        $this->displayBlock('mainContent', $context, $blocks);
        // line 15
        echo "    </div>
    <div class=\"statusMessageArea emptyOnStart\">
        ";
        // line 18
        echo "    </div>
    <div class=\"submissionControls studyAreaItem\">
        ";
        // line 20
        $this->displayBlock('submissionControls', $context, $blocks);
        // line 22
        echo "    </div>

    <div class=\"bottomInstructions studyAreaItem\">
        ";
        // line 25
        $this->displayBlock('bottomInstructions', $context, $blocks);
        // line 27
        echo "    </div>
</div>";
    }

    // line 3
    public function block_areaTitle($context, array $blocks = array())
    {
        // line 4
        echo "        ";
    }

    // line 8
    public function block_topInstruction($context, array $blocks = array())
    {
        // line 9
        echo "        ";
    }

    // line 13
    public function block_mainContent($context, array $blocks = array())
    {
        // line 14
        echo "        ";
    }

    // line 20
    public function block_submissionControls($context, array $blocks = array())
    {
        // line 21
        echo "        ";
    }

    // line 25
    public function block_bottomInstructions($context, array $blocks = array())
    {
        // line 26
        echo "        ";
    }

    public function getTemplateName()
    {
        return "studyarea.base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 26,  96 => 25,  92 => 21,  89 => 20,  85 => 14,  82 => 13,  78 => 9,  75 => 8,  71 => 4,  68 => 3,  63 => 27,  61 => 25,  56 => 22,  54 => 20,  50 => 18,  46 => 15,  44 => 13,  39 => 10,  37 => 8,  32 => 5,  30 => 3,  24 => 1,);
    }
}
