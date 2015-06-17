<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 * 
 */

/**
 * @author adam
 */

//building
$originalinclude = ini_get('include_path');
//var_dump(ini_get('include_path'));

setenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
setenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");
setenv("PRAY_DB_NAME=painprayer_test");
setenv("PRAY_USERNAME=testuser3");
setenv("PRAY_PASSWORD=testpass3");
setenv("PRAY_RUNTYPE=testing");

//testing
ini_set('include_path', '/Users/adam/Dropbox/painprayer/src/lib');
//require_once('filemaster.php');
require_once('../filemaster.php');
//require '../vendor/autoload.php';

///Users/adam/.composer/vendor/
ini_set('include_path', '/Users/adam/.composer/vendor');
require_once('autoload.php');

ini_set('include_path', $originalinclude);


//To create tests, comment out the filemaster include below. Then restore it for when running tests
//require_once('../filemaster.php');
//require_once('/filemaster.php');