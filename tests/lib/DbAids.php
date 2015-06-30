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
        echo "\n Populating user demographics tables \n";
        $ages = array("18-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80", "81-90", "90+");
        foreach($ages as $a)
        {
            $q = \AgeQuery::create()->filterByAge($a)->findOneOrCreate();
            $q->save($conn);
        }

        echo "\n Populating users \n";
        try {
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $num; $i++) {
                $u = new \User();
                $u->setNickname($faker->name());

//                $u = \UserQuery::create()->filterByNickname($faker->name())->findOneOrCreate();
                $u->setEmail($faker->email());
                if( $i & 1 ) {
                    //odd
                    $u->setSex('female');
                } else {
                    //even
                    $u->setSex('male');
                }
                $u->setAge($ages[array_rand($ages)]);
                $u->save($conn);
            }
        } catch (\Exception $e) {
            echo 'users population error: ' . $e->getMessage();
        }
    }

    public static function populate_user_ethnicities($conn=null, $num=10)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $num; $i++) {
//            $z = \RaceQuery::create()->filterByRace($faker->word())->findOneOrCreate();
//            $z->save($conn);
            $e = \EthnicityQuery::create()
                ->filterByIdentity($faker->word())
                ->findOneOrCreate();
            if( $i & 1 ) {
                //odd
                $e->setType('race');
            } else {
                //even
                $e->setType('ethnicity');
            }
            $e->save($conn);
        }

        $users = \UserQuery::create()->find();
        $ethnicities = \EthnicityQuery::create()->find();
        foreach($users as $user){
            foreach($ethnicities as $e){
                $ue = \UserDemosQuery::create()
                    ->filterByUser($user)
                    ->filterByEthnicity($e)
                    ->findOneOrCreate();
                $ue->save($conn);
            }
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
                $p->save($conn);
            }
        } catch (\Exception $e) {
            echo 'prayer population error: ' . $e->getMessage();
        }
    }

    /**
     * Creates associations for all objects associated with a trial
     * @param null $conn
     *
     */
    public static function populate_trial_assoc($conn=null)
    {
        echo "\n Populating trial prayer \n";
        try{
            $i = 0;
            $trials = \TrialQuery::create()->find();
            foreach($trials as $trial){
                $prayers = \PrayerQuery::create()->find();
                shuffle($prayers);
                $t = \TrialPrayerAssociationQuery::create()
                    ->filterByTrial($trial)
                    ->filterByPrayer($prayers[0])
                    ->findOneOrCreate();
                $t->save($conn);

                $items = \PainAssessmentItemQuery::create()->find();
                foreach ($items as $item) {
                    $r = \TrialPainRatingAssociationQuery::create()
                        ->filterByTrial($trial)
                        ->filterByPainAssessmentItem($item)
                        ->findOneOrCreate();
                    $r->save($conn);
                }
            }

        } catch (\Exception $e) {
            echo 'prayer population error: ' . $e->getMessage();
        }
    }

    public static function populate_prayer_assignments($conn=null)
    {
        $faker = \Faker\Factory::create();
        $users = self::getUsers();
        for($i=0; $i< count($users); $i++)
        {
            $p = new \AssignedPrayer();
            $p->setAgent($users[$i]);
            $i += 1;
            $p->setPatient($users[$i]);
            $p->setPrayerDate($faker->date());
            $p->setAssignmenthash($faker->sha1);
            $p->save($conn);
        }
    }

    protected static function getUsers()
    {
        return \UserQuery::create()->find();
    }
}



