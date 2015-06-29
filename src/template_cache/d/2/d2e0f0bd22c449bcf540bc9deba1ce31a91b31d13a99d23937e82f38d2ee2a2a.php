<?php

/* page.base.head.twig */
class __TwigTemplate_d2e0f0bd22c449bcf540bc9deba1ce31a91b31d13a99d23937e82f38d2ee2a2a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'head_block' => array($this, 'block_head_block'),
            'navArea' => array($this, 'block_navArea'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset = utf-8\"/>
    <meta name=viewport content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["page_title"]) ? $context["page_title"] : null), "html", null, true);
        echo "</title>
    <link href='inc/img/favicon.ico' rel='icon' type='image/x-icon'/>

    ";
        // line 9
        $this->loadTemplate("js.jqueryCss.twig", "page.base.head.twig", 9)->display($context);
        // line 10
        echo "    ";
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "
    ";
        // line 18
        $this->displayBlock('head_block', $context, $blocks);
        // line 20
        echo "</head>
<body>
<div class=\"container\">
    ";
        // line 23
        $this->displayBlock('navArea', $context, $blocks);
        // line 25
        echo "    <div id=\"mainBody\">";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "        ";
        if ((twig_length_filter($this->env, (isset($context["stylesheets"]) ? $context["stylesheets"] : null)) > 0)) {
            // line 12
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["stylesheets"]) ? $context["stylesheets"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["sheet"]) {
                // line 13
                echo "                <link href=\"";
                echo twig_escape_filter($this->env, $context["sheet"], "html", null, true);
                echo "\" rel=\"stylesheet\" />
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sheet'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "        ";
        }
        // line 16
        echo "    ";
    }

    // line 18
    public function block_head_block($context, array $blocks = array())
    {
        // line 19
        echo "    ";
    }

    // line 23
    public function block_navArea($context, array $blocks = array())
    {
        // line 24
        echo "    ";
    }

    public function getTemplateName()
    {
        return "page.base.head.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 24,  90 => 23,  86 => 19,  83 => 18,  79 => 16,  76 => 15,  67 => 13,  62 => 12,  59 => 11,  56 => 10,  52 => 25,  50 => 23,  45 => 20,  43 => 18,  40 => 17,  37 => 10,  35 => 9,  29 => 6,  22 => 1,);
    }
}
