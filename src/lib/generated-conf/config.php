<?php

//$dbname = getenv("PRAY_DB_NAME");
//$username = getenv("PRAY_USERNAME");
//$password = getenv("PRAY_PASSWORD");
//
$dbname = 'painprayer';
$dbname_test = 'painprayer_test';
$username = 'testuser4';
$password = 'testpass4';

$runtype = getenv("RUNTYPE");


//$dbconn = !empty($runtype) ? ($runtype == 'testing' ? 'test' : 'main') : 'main';

//echo "\n dbconn :" . $dbconn . "\n";



$serviceContainer_test = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer_test->checkVersion('2.0.0-dev');
$serviceContainer_test->setAdapterClass('test', 'mysql');
$manager_test = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager_test->setConfiguration(array (
    'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
    'dsn' => "mysql:host=localhost;dbname=$dbname_test",
    'user' => $username,
    'password' => $password
));
$manager_test->setName('test');
$serviceContainer_test->setConnectionManager('test', $manager_test);


$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('main', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'dsn' => "mysql:host=localhost;dbname=$dbname",
  'user' => $username,
  'password' => $password
));
$manager->setName('main');
$serviceContainer->setConnectionManager('main', $manager);
$serviceContainer->setDefaultDatasource('main');