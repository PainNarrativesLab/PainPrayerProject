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


putenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
putenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");
putenv("PRAY_TEMPLATE_CACHE=/Users/adam/Dropbox/painprayer/src/template_cache");
putenv("PRAY_TEMPLATE_PATH=/Users/adam/Dropbox/painprayer/src/templates");
putenv("PRAY_DB_NAME=painprayer");
putenv("PRAY_USERNAME=testuser3");
putenv("PRAY_PASSWORD=testpass3");

putenv("PRAY_RUNTYPE=normal");

// above will be eventually removed


$src = getenv("PRAY_SRC_PATH");
$vendor = getenv("PRAY_VENDOR_PATH");
$template_cache = getenv("PRAY_TEMPLATE_CACHE");
$template_folder = getenv("PRAY_TEMPLATE_PATH");
$runtype = getenv("PRAY_RUNTYPE");

global $src, $vendor, $template_cache, $template_folder, $runtype;

//autoloader
require_once "$vendor/autoload.php";

// setup Propel
require_once "$src/lib/generated-conf/config.php";

# ---------------------------------------------------- Global functions
/**
 * Wraps things to be output to html page
 * @param string $output
 */
function _H($output){
    echo \htmlspecialchars($output, ENT_QUOTES, "UTF-8");
}

/**
 * Redirects to index page from anywhere
 */
function redirect(){
    header('Location: index.php');
    exit();
}

if(!defined("AGES")){
    $ages = array("18-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80", "81-90", "90+");
    define("AGES", $ages);
}

# ---------------------------------------------------- LOGGING AND ERROR HANDLING
#development error handler
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();


//$defaultLogger = new Logger('defaultLogger');
//$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));
//
//$serviceContainer->setLogger('defaultLogger', $defaultLogger);

//Global constants