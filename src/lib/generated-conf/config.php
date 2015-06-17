<?php

//$dbname = getenv("PRAY_DB_NAME");
//$username = getenv("PRAY_USERNAME");
//$password = getenv("PRAY_PASSWORD");
//
$dbname = 'painprayer';
$username = 'testuser4';
$password = 'testpass4';

$runtype = getenv("RUNTYPE");
$dbconn = !empty($runtype) ? ($runtype == 'testing' ? 'testing' : 'main') : 'main';

//echo "\n dbconn :" . $dbconn . "\n";

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
$serviceContainer->setConnectionManager($dbconn, $manager);
$serviceContainer->setDefaultDatasource($dbconn);