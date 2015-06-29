<?php

/* page.base.pagebottom.twig */
class __TwigTemplate_2ff487dea23bb8a9a717aa2ac3a9858180f81c3ed33ceef4e205b21b12d872f0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'footer' => array($this, 'block_footer'),
            'scriptBox' => array($this, 'block_scriptBox'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "</div> <!-- close mainBody -->
    ";
        // line 2
        $this->displayBlock('footer', $context, $blocks);
        // line 5
        echo "
</div> <!-- close container -->
<div id=\"scriptBox\">
    ";
        // line 8
        $this->loadTemplate("js.jquery.twig", "page.base.pagebottom.twig", 8)->display($context);
        // line 9
        echo "    <script type=\"text/javascript\">
        ";
        // line 11
        echo "            ";
        echo (isset($context["scriptlist"]) ? $context["scriptlist"] : null);
        echo "
        ";
        // line 13
        echo "    </script>
    ";
        // line 14
        $this->loadTemplate("js.scriptloader.twig", "page.base.pagebottom.twig", 14)->display($context);
        // line 15
        echo "    <script type=\"text/javascript\">
        \$(document).ready(function() {
        ";
        // line 18
        echo "            ";
        echo (isset($context["onload"]) ? $context["onload"] : null);
        echo "
        ";
        // line 20
        echo "            if(scripts){
                scriptLoader(scripts, scripts.length, onLoad, 0);
            }
        });
    </script>
    ";
        // line 25
        $this->displayBlock('scriptBox', $context, $blocks);
        // line 27
        echo "</div>
</body>
</html>";
    }

    // line 2
    public function block_footer($context, array $blocks = array())
    {
        // line 3
        echo "        ";
        $this->loadTemplate("page.base.footer.twig", "page.base.pagebottom.twig", 3)->display($context);
        // line 4
        echo "    ";
    }

    // line 25
    public function block_scriptBox($context, array $blocks = array())
    {
        // line 26
        echo "    ";
    }

    public function getTemplateName()
    {
        return "page.base.pagebottom.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 26,  80 => 25,  76 => 4,  73 => 3,  70 => 2,  64 => 27,  62 => 25,  55 => 20,  50 => 18,  46 => 15,  44 => 14,  41 => 13,  36 => 11,  33 => 9,  31 => 8,  26 => 5,  24 => 2,  21 => 1,);
    }
}
