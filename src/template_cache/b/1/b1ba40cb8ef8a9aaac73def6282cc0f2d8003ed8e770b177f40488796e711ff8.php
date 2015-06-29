<?php

/* studyarea.prayertask.base.twig */
class __TwigTemplate_b1ba40cb8ef8a9aaac73def6282cc0f2d8003ed8e770b177f40488796e711ff8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.base.twig", "studyarea.prayertask.base.twig", 1);
        $this->blocks = array(
            'areaTitle' => array($this, 'block_areaTitle'),
            'topInstruction' => array($this, 'block_topInstruction'),
            'topInstructionPrayer' => array($this, 'block_topInstructionPrayer'),
            'mainContent' => array($this, 'block_mainContent'),
            'mainContentPrayer' => array($this, 'block_mainContentPrayer'),
            'statusArea' => array($this, 'block_statusArea'),
            'submissionControls' => array($this, 'block_submissionControls'),
            'submissionControlsPrayer' => array($this, 'block_submissionControlsPrayer'),
            'bottomInstructions' => array($this, 'block_bottomInstructions'),
            'bottomInstructionsPrayer' => array($this, 'block_bottomInstructionsPrayer'),
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
        echo "     Prayer assignment
 ";
    }

    // line 7
    public function block_topInstruction($context, array $blocks = array())
    {
        // line 8
        echo "    <div class=\"defaultMessage\">
        Please complete the pain questionnaire above to access your prayer task.
    </div>
    <div class=\"startHidden\">
        ";
        // line 12
        $this->displayBlock('topInstructionPrayer', $context, $blocks);
        // line 14
        echo "    </div>
";
    }

    // line 12
    public function block_topInstructionPrayer($context, array $blocks = array())
    {
        // line 13
        echo "        ";
    }

    // line 17
    public function block_mainContent($context, array $blocks = array())
    {
        // line 18
        echo "    <div class=\"startHidden prayerBody\">
        ";
        // line 19
        $this->displayBlock('mainContentPrayer', $context, $blocks);
        // line 21
        echo "    </div>
";
    }

    // line 19
    public function block_mainContentPrayer($context, array $blocks = array())
    {
        // line 20
        echo "        ";
    }

    // line 24
    public function block_statusArea($context, array $blocks = array())
    {
        // line 25
        echo "    <div class=\"statusMessageArea emptyOnStart startHidden\">
        ";
        // line 27
        echo "    </div>
";
    }

    // line 30
    public function block_submissionControls($context, array $blocks = array())
    {
        // line 31
        echo "    <div class=\"startHidden\">
        ";
        // line 32
        $this->displayBlock('submissionControlsPrayer', $context, $blocks);
        // line 34
        echo "    </div>
";
    }

    // line 32
    public function block_submissionControlsPrayer($context, array $blocks = array())
    {
        // line 33
        echo "        ";
    }

    // line 37
    public function block_bottomInstructions($context, array $blocks = array())
    {
        // line 38
        echo "    <div class=\"startHidden\">
        ";
        // line 39
        $this->displayBlock('bottomInstructionsPrayer', $context, $blocks);
        // line 41
        echo "    </div>
";
    }

    // line 39
    public function block_bottomInstructionsPrayer($context, array $blocks = array())
    {
        // line 40
        echo "        ";
    }

    public function getTemplateName()
    {
        return "studyarea.prayertask.base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 40,  132 => 39,  127 => 41,  125 => 39,  122 => 38,  119 => 37,  115 => 33,  112 => 32,  107 => 34,  105 => 32,  102 => 31,  99 => 30,  94 => 27,  91 => 25,  88 => 24,  84 => 20,  81 => 19,  76 => 21,  74 => 19,  71 => 18,  68 => 17,  64 => 13,  61 => 12,  56 => 14,  54 => 12,  48 => 8,  45 => 7,  40 => 4,  37 => 3,  11 => 1,);
    }
}
