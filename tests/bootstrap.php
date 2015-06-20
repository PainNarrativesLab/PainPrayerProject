<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 * 
 */

/**
 * @author adam
 */


putenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
putenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");
putenv("PRAY_DB_NAME=painprayer_test");
putenv("PRAY_USERNAME=testuser3");
putenv("PRAY_PASSWORD=testpass3");
putenv("PRAY_RUNTYPE=testing");

$src = getenv("PRAY_SRC_PATH");
$vendor = getenv("PRAY_VENDOR_PATH");
require_once("$vendor/autoload.php");

# initialize propel
require_once("$src/lib/generated-conf/config.php");
//require_once("$vendor/propel/propel/tests/bootstrap.php");

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
    $serviceContainer->setDefaultDatasource('test');
//\Propel::setConnection(
//    "propel",
//    Propel::getConnection(SqliteSetup::$databaseName)
//);

echo "\n connections made \n";

////building
//$originalinclude = ini_get('include_path');
////
//ini_set('include_path', '../vendor/');
////
////ini_set('include_path', '/Users/adam/.composer/vendor');
////
//ini_set('include_path', $originalinclude);
//


//testing
//ini_set('include_path', '/Users/adam/Dropbox/painprayer/src/lib');
//require_once('filemaster.php');
//require_once('../filemaster.php');
//require '../vendor/autoload.php';

///Users/adam/.composer/vendor/
//ini_set('include_path', '/Users/adam/.composer/vendor');
//require_once('autoload.php');

//ini_set('include_path', $originalinclude);

\lib\DbAids::populate_users();

//To create tests, comment out the filemaster include below. Then restore it for when running tests
//require_once('../filemaster.php');
//require_once('/filemaster.php');