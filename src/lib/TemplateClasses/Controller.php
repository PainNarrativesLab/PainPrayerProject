<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/6/15
 * Time: 7:37 PM
 */

namespace TemplateClasses;


class Controller
{
    const DEBUG = true;

    static public $cache_dir;

    static public $template_dir;

    public $loader;

    public $twig;

    public $template;

    public $variables = array();

    static public function setLocations()
    {
        if (empty(self::$cache_dir)) {
            self::$cache_dir = getenv("PRAY_TEMPLATE_CACHE");
        }
        if (empty(self::$template_dir)) {
            self::$template_dir = getenv("PRAY_TEMPLATE_PATH");
        }
    }

    public function __construct()
    {
        // include and register Twig auto-loader
        \Twig_Autoloader::register();
        try {
            self::setLocations();
            $this->loader = new \Twig_Loader_Filesystem(self::$template_dir);

            // initialize Twig environment
            $this->twig = new \Twig_Environment($this->loader, array(
                'cache' => self::$cache_dir,
                'debug' => self::DEBUG
            ));
            $this->twig->getExtension('core')->setTimezone('America/Los_Angeles');
        } catch (Exception $e) {
            die ('ERROR: Twig problem: ' . $e->getMessage());
        }
    }

    /**
     * Adds variables to use in rendering the template
     * @param array $to_add
     */
    public function add_variables(array $to_add)
    {
//        $this->variables = array_merge($this->variables, $to_add);
        $this->variables += $to_add;
    }

    /**
     * Loads a template as current
     * @param $template_name string
     */
    public function load($template_name)
    {
        // load template
        $this->template = $this->twig->loadTemplate($template_name);
    }

    /**
     * Renders the specified template with variables loaded via add_variables()
     * @param $template_name
     */
    public function render($template_name)
    {
        try {
            $this->load($template_name);
            // render template
            echo $this->template->render($this->variables);
        } catch (Exception $e) {
            die ('ERROR: Twig problem: ' . $e->getMessage());
        }
    }
}