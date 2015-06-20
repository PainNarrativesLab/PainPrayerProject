<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:43 AM
 */

namespace Tasks\Assignments\service;


class HashMaker implements IHashMaker
{
    const LOOKUP_SIZE = 225;
    const MAX_TRIES = 10;

    /**
     * Makes a candidate random hash. Checks whether it already exists in db
     * @return string
     */
    public function makeHash()
    {
        $i = 0;
        while(FALSE || $i != self::MAX_TRIES){
            $candidate = sha1(\openssl_random_pseudo_bytes(self::LOOKUP_SIZE));
            if (empty($this->checkExists($candidate))) {
                return $candidate;
            }
            else{
                $i++;
            }
        }
    }

    protected function checkExists($candidate)
    {
        return \AssignedPrayerQuery::create()
            ->filterByAssignmenthash($candidate)
            ->findOne();
    }
}