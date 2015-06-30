<?php

require_once("DbAids.php");



putenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
putenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");
putenv("PRAY_DB_NAME=painprayer_test");
putenv("PRAY_USERNAME=testuser3");
putenv("PRAY_PASSWORD=testpass3");
putenv("PRAY_RUNTYPE=testing");

$src = getenv("PRAY_SRC_PATH");
$vendor = getenv("PRAY_VENDOR_PATH");
require_once("$vendor/autoload.php");

// setup Propel
require_once "$src/lib/generated-conf/config.php";

$dbs = array('main', 'test');
foreach($dbs as $db){
    echo "\n -------------- populating db : $db --------------------- \n";
    \lib\DbAids::populate_users(\Propel\Runtime\Propel::getConnection($db));

    \lib\DbAids::populate_user_ethnicities(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_assessment_items(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_prayers(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_trials(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_trial_assoc(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_prayer_assignments(\Propel\Runtime\Propel::getConnection($db));
}





# initialize propel
//require_once("$src/lib/generated-conf/config.php");
//require_once("$vendor/propel/propel/tests/bootstrap.php");
//\Propel\Runtime\Propel::getConnection('test');
//\Propel\Runtime\Propel::set
//Propel::setConnection(
//    "propel",
//    Propel::getConnection('test')
//);

// Get current configuration
//$config = \Propel::getConfiguration();
//
//// Change DB configuration
//$config['datasources']['default']['connection']['dsn'] = 'mysql:host=127.0.0.1;port=3306;dbname=dbname;charset=UTF8';
//$config['datasources']['default']['connection']['user'] = 'username';
//$config['datasources']['default']['connection']['password'] = 'password';
//
//// Apply configuration
//\Propel::setConfiguration($config);
//\Propel::initialize();

