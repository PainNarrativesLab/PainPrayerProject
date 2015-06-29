<?php

/* studyarea.painquestions.checkboxes.twig */
class __TwigTemplate_fd3911c866d2a821d366bb6932fe2d597cc405f4e3a1419e616f4bbb0b4732d6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["assessmentItems"]) ? $context["assessmentItems"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    <div class=\"painItemHolder\">
        <label class=\"painPrompt\" for=\"painCheckHolder_";
            // line 3
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\">
            ";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemText", array()), "html", null, true);
            echo "
        </label>
        ";
            // line 7
            echo "            <radioset id=\"painCheckHolder_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
            echo "\">
                ";
            // line 8
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(0, 5, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 9
                echo "                    <label for=\"painCheck_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "</label>
                    <input type=\"checkbox\" class=\"painChecks\" id=\"painCheck_";
                // line 10
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "itemId", array()), "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                echo "\"/>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "            </radioset>
        ";
            // line 14
            echo "    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return array (  64 => 14,  61 => 12,  51 => 10,  44 => 9,  40 => 8,  35 => 7,  30 => 4,  26 => 3,  23 => 2,  19 => 1,);
    }
}
