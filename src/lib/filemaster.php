<?php
/**
 * Configuration file for inclusion on all pages.
 *
 * User: adam
 * Date: 5/24/15
 * Time: 3:00 PM
 */
//autoloader
require_once __DIR__.'/vendor/autoload.php';
// setup Propel
require_once '/generated-conf/config.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);

//Global constants
//The base address to use for any custom links to the site
const SITE_ROOT = '';