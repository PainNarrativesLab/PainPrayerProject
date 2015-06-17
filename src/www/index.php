<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/24/15
 * Time: 1:36 PM
 */
//require_once __DIR__.'/vendor/autoload.php';

putenv("PRAY_SRC_PATH=/Users/adam/Dropbox/painprayer/src");
putenv("PRAY_VENDOR_PATH=/Users/adam/Dropbox/painprayer/vendor");




putenv("PRAY_DB_NAME=painprayer");
putenv("PRAY_USERNAME=testuser4");
putenv("PRAY_PASSWORD=testpass4");
putenv("PRAY_RUNTYPE=testing");

$src = getenv("PRAY_SRC_PATH");
$vendor = getenv("PRAY_VENDOR_PATH");

//require_once __DIR__.'/src/lib/filemaster.php';

require_once("$vendor/autoload.php");
// setup Propel
require_once "$src/lib/generated-conf/config.php";

$faker = \Faker\Factory::create();
$u = \UserQuery::create()->filterByNickname($faker->name())->findOneOrCreate();
$u->setEmail($faker->email());
$u->save();
//\lib\DbAids::populate_users();