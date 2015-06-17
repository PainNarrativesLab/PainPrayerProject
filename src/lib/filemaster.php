<?php
/**
 * Configuration file for inclusion on all pages.
 *
 * User: adam
 * Date: 5/24/15
 * Time: 3:00 PM
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


setenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
setenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");

setenv("PRAY_DB_NAME=painprayer");
setenv("PRAY_USERNAME=testuser3");
setenv("PRAY_PASSWORD=testpass3");

setenv("PRAY_RUNTYPE=normal");

$src = getenv("PRAY_SRC_PATH");
$template_cache = getenv("PRAY_TEMPLATE_CACHE");
$template_folder = getenv("PRAY_TEMPLATE_FOLDER");
$runtype = getenv("PRAY_RUNTYPE");



//autoloader
require_once __DIR__.'/vendor/autoload.php';
// setup Propel
require_once '/generated-conf/config.php';

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);

//Global constants
//The base address to use for any custom links to the site
const SITE_ROOT = '';