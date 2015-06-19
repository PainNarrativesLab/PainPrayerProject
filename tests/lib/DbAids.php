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
    public static function populate_users($conn=null, $num = 10)
    {
        echo "\n Populating users \n";
        try {
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $num; $i++) {
                $u = new \User();
                $u->setNickname($faker->name());
//                $u = \UserQuery::create()->filterByNickname($faker->name())->findOneOrCreate();
                $u->setEmail($faker->email());
                $u->save($conn);
            }
        } catch (\Exception $e) {
            echo 'users population error: ' . $e->getMessage();
        }
    }

    public static function populate_assessment_items($conn=null, $num=5)
    {
        echo "\n Populating assessment items \n";
        try{
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $num; $i++) {
            $ai = new \PainAssessmentItem();
            $ai->setText($faker->text());
            $ai->save($conn);
        }
        } catch (\Exception $e) {
        echo 'assessment items population error: ' . $e->getMessage();
}
    }

    public static function populate_prayers($conn=null, $num=2)
    {
        echo "\n Populating prayers \n";
        try{
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $num; $i++) {
                $p = new \Prayer();
                $p->setText($faker->paragraph(5));
                $p->save($conn);
            }
        } catch (\Exception $e) {
            echo 'prayer population error: ' . $e->getMessage();
        }
    }

    public static function populate_trials($conn=null, $num=2)
    {
        echo "\n Populating trials \n";
        try{
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $num; $i++) {
                $p = new \Trial();
                $p->setText($faker->paragraph(5));
                $p->save($conn);
            }
        } catch (\Exception $e) {
            echo 'prayer population error: ' . $e->getMessage();
        }
    }
}

