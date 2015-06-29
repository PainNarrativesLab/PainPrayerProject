<?php

/* studyarea.base.twig */
class __TwigTemplate_e1ba6116fb06c52defb96c8cf642b593c76305072f17e76638b90b98422ada79 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'areaTitle' => array($this, 'block_areaTitle'),
            'topInstruction' => array($this, 'block_topInstruction'),
            'mainContent' => array($this, 'block_mainContent'),
            'statusArea' => array($this, 'block_statusArea'),
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

    <div class=\"topInstructions studyAreaItem \">
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

    ";
        // line 17
        $this->displayBlock('statusArea', $context, $blocks);
        // line 19
        echo "
    <div class=\"submissionControls studyAreaItem \">
        ";
        // line 21
        $this->displayBlock('submissionControls', $context, $blocks);
        // line 23
        echo "    </div>

    <div class=\"bottomInstructions studyAreaItem \">
        ";
        // line 26
        $this->displayBlock('bottomInstructions', $context, $blocks);
        // line 28
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

    // line 17
    public function block_statusArea($context, array $blocks = array())
    {
        // line 18
        echo "    ";
    }

    // line 21
    public function block_submissionControls($context, array $blocks = array())
    {
        // line 22
        echo "        ";
    }

    // line 26
    public function block_bottomInstructions($context, array $blocks = array())
    {
        // line 27
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
        return array (  109 => 27,  106 => 26,  102 => 22,  99 => 21,  95 => 18,  92 => 17,  88 => 14,  85 => 13,  81 => 9,  78 => 8,  74 => 4,  71 => 3,  66 => 28,  64 => 26,  59 => 23,  57 => 21,  53 => 19,  51 => 17,  47 => 15,  45 => 13,  40 => 10,  38 => 8,  33 => 5,  31 => 3,  25 => 1,);
    }
}
