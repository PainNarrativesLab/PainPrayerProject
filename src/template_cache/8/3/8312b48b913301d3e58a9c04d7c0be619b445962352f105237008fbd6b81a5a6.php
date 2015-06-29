<?php

/* js.scriptloader.twig */
class __TwigTemplate_8312b48b913301d3e58a9c04d7c0be619b445962352f105237008fbd6b81a5a6 extends Twig_Template
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
        // line 2
        echo "<script type=\"text/javascript\">
    /**
     * Loads the scripts for the page and calls onload when done
     * @param {array} scripts Array of scripts to load
     * @param {function} onLoad Function to call when done loading
     * @param {int} i Counter default = 0
     * @returns {undefined}
     */
    function scriptLoader(scripts, numscripts, onLoad, i) {
        if (numscripts === 1) {
            \$.getScript(scripts[i]).done(function (data, textStatus) {
                if (textStatus) {
                    onLoad();
                }
            });
        }
        else {
            if (i === numscripts) { //done
                onLoad();
            }
            else {
                \$.getScript(scripts[i]).done(function (data, textStatus) {
                    if (textStatus) {
                        i++;
                        scriptLoader(scripts, numscripts, onLoad, i);
                    }
                });
            }
        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "js.scriptloader.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }
}
