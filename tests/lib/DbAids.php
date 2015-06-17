<?php
/**
 * tools for populating the databases
 *
 * Created by PhpStorm.
 * User: adam
 * Date: 6/17/15
 * Time: 9:20 AM
 */
namespace lib;

use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Class DbAids
 * These are tools for putting the database into a known state
 */
class DbAids 
{
// Hopefully someday the faker library will be fixed so that we can just do:
//        $populator = new \Faker\ORM\Propel\Populator($faker);
//        $populator->addEntity('Exam', 100, array(
//            'CreatedAt' => null,
//            'UpdatedAt' => null
//        ));
//        $this->inserted_examids = $populator->execute();

    public static function populate_all()
    {
//        self::populate_item_assignments();
//        self::populate_restrictors();
//        self::populate_students();
//        self::populate_classes();
    }

    /**
     * Creates fake users
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function populate_users($num = 10)
    {
        echo "\n Populating users \n";
        try {
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $num; $i++) {
                $u = new \User();
                $u->setNickname($faker->name());
//                $u = \UserQuery::create()->filterByNickname($faker->name())->findOneOrCreate();
                $u->setEmail($faker->email());
                echo $u->save();
            }
        } catch (\Exception $e) {
            echo 'population error: ' . $e->getMessage();
        }
    }

}

