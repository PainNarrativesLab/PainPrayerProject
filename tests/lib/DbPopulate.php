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



//$dbname = 'painprayer';
$username = 'testuser4';
$password = 'testpass4';
$dbname = 'painprayer_test';
$dbconn = 'test';
//$dbconn = 'main';

$serviceContainer_test = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer_test->checkVersion('2.0.0-dev');
$serviceContainer_test->setAdapterClass('test', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => "mysql:host=localhost;dbname=$dbname",
    'user' => $username,
    'password' => $password
));
$manager->setName($dbconn);
$serviceContainer_test->setConnectionManager('test', $manager);
//$serviceContainer_test->setDefaultDatasource('test');

$dbname = 'painprayer';
$dbconn = 'main';
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass($dbconn, 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => "mysql:host=localhost;dbname=$dbname",
    'user' => $username,
    'password' => $password
));
$manager->setName($dbconn);
$serviceContainer->setConnectionManager('main', $manager);
$serviceContainer->setDefaultDatasource('main');



$dbs = array('main', 'test');
foreach($dbs as $db){
    echo "\n -------------- populating db : $db --------------------- \n";
    \lib\DbAids::populate_users(\Propel\Runtime\Propel::getConnection($db));
    \lib\DbAids::populate_assessment_items(\Propel\Runtime\Propel::getConnection($db));
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

