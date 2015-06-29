<?php

/* studyarea.prayertask.base.twig */
class __TwigTemplate_0547e814b7a6b1fa56c629a8753de1860f7d3e46a279ed8b00f92579fb323bcf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.base.twig", "studyarea.prayertask.base.twig", 1);
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
        echo "     Prayer assignment
 ";
    }

    // line 7
    public function block_topInstruction($context, array $blocks = array())
    {
        // line 8
        echo "    Once you have completed the above pain questionairre, please follow the instructions which will appear below.
";
    }

    // line 11
    public function block_mainContent($context, array $blocks = array())
    {
        // line 12
        echo "    <div class=\"startHidden\">
        ";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["mainContent"]) ? $context["mainContent"] : null), "html", null, true);
        echo "
    </div>
";
    }

    // line 17
    public function block_submissionControls($context, array $blocks = array())
    {
        // line 18
        echo "    <div class=\"startHidden\">
        <input type=\"button\" id=\"prayerSubmit\" class=\"prettyButton\" value=\"Prayer completed\"/>
    </div>
";
    }

    // line 23
    public function block_bottomInstructions($context, array $blocks = array())
    {
        // line 24
        echo "    <div class=\"startHidden\">
    </div>
";
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
        return array (  74 => 24,  71 => 23,  64 => 18,  61 => 17,  54 => 13,  51 => 12,  48 => 11,  43 => 8,  40 => 7,  35 => 4,  32 => 3,  11 => 1,);
    }
}
