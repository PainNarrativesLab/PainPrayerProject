<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 11:52 AM
 */

namespace Tasks\Assignments;


class PrayerAssignmentFactory 
{


    /**
     * Creates a new partnership and populates a PrayerAssignment object
     * with the partnership. Returns the PrayerAssignment
     * @param $agent
     * @param $patient
     * @param $date
     * @return PrayerAssignment
     */
    static public function create($agent, $patient, $date)
    {
        $maker = new \Tasks\Assignments\service\PartnershipMaker();
        $maker->setDao(new \Tasks\Assignments\dao\PartnershipDao());
        $maker->setHashMaker(new \Tasks\Assignments\service\HashMaker());
        $partnership = $maker->make($agent, $patient, $date);
        return self::populate($partnership);
    }

    /**
     * Takes either a user object (the agent) or a assignment hash
     * and returns a PrayerAssignment object
     * @param $identifier
     * @param null $date
     * @return PrayerAssignment
     */
    static public function load($identifier, $date=null)
    {
        $loader = new \Tasks\Assignments\service\PartnershipLoader();
        $loader->setDao(new \Tasks\Assignments\dao\PartnershipDao());
        $partnership = $loader->load($identifier, $date);
        return self::populate($partnership);
    }

    static protected function populate($partnership)
    {
        $object = new \Tasks\Assignments\PrayerAssignment();
        $object->setAgent($partnership->getAgent());
        $object->setPatient($partnership->getPatient());
        $object->setStartDate($partnership->getPrayerdate());
        $object->setAssignmentHash($partnership->getAssignmenthash());
        return $object;
    }
}