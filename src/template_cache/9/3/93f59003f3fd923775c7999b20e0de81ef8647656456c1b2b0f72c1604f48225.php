<?php

/* studyarea.painquestions.checkboxes.twig */
class __TwigTemplate_93f59003f3fd923775c7999b20e0de81ef8647656456c1b2b0f72c1604f48225 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("studyarea.painquestions.twig", "studyarea.painquestions.checkboxes.twig", 1);
        $this->blocks = array(
            'mainContent' => array($this, 'block_mainContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "studyarea.painquestions.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_mainContent($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $context["itemCount"] = 0;
        // line 4
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["assessmentItems"]) ? $context["assessmentItems"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 5
            echo "        ";
            $context["itemCount"] = ((isset($context["itemCount"]) ? $context["itemCount"] : null) + 1);
            // line 6
            echo "        <div class=\"painItemHolder\" id=\"painItem_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\">
            <div class=\"statusArea\" id=\"painCheckStatus_";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\"></div>
            <div class=\"painCheckArea\">
                <label class=\"painPrompt\" for=\"painCheckHolder_";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\">
                    ";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemText", array()), "html", null, true);
            echo "
                </label>
                <radioset class=\"buttonify\" id=\"painCheckHolder_";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\">
                    ";
            // line 13
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(0, 5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 14
                echo "                        <label for=\"painCheck_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</label>
                        <input type=\"radio\" class=\"painChecks\" id=\"painCheck_";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\"
                               data-itemid=\"";
                // line 16
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "\" name=\"painCheck_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\"/>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "                </radioset>
            </div>
            <input type=\"hidden\" class=\"itemComplete\" id=\"itemComplete_";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\" value=\"false\" />
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "    <input type=\"hidden\" id=\"itemCount\" value=\"";
        echo twig_escape_filter($this->env, (isset($context["itemCount"]) ? $context["itemCount"] : null), "html", null, true);
        echo "\"/>
";
    }

    public function getTemplateName()
    {
        return "studyarea.painquestions.checkboxes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 23,  100 => 20,  96 => 18,  84 => 16,  78 => 15,  69 => 14,  65 => 13,  61 => 12,  56 => 10,  52 => 9,  47 => 7,  42 => 6,  39 => 5,  34 => 4,  31 => 3,  28 => 2,  11 => 1,);
    }
}
