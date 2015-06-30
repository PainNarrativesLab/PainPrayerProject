<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/29/15
 * Time: 6:07 PM
 */

namespace Registration;


class UserAdder 
{

    const KEY_NICKNAME = 'nickname';
    const KEY_EMAIL = 'email';
    const KEY_AGE = 'age';
    const KEY_SEX = 'sex';
    const KEY_RACE = 'race';
    const KEY_ETHNICITY = 'ethnicity';


    /** @var  \Security\cleaners\ICleanerFactory */
    protected $cleaner;

    protected $user;

    protected $userRaces = array();

    protected $userEthnicities = array();

    public function addUser(\RequestHandling\IRequest $request)
    {
        try {
            $incoming = $request->http;
            $this->handleNickname($incoming);
            $this->handleAge($incoming);
            $this->handleEmail($incoming);
            $this->user->save();
            $this->handleEthnicity($incoming);
            //$this->handleRace($incoming);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param mixed $cleaner
     */
    public function setCleaner(\Security\cleaners\ICleanerFactory $cleaner)
    {
        $this->cleaner = $cleaner;
    }

    public function handleNickname(array $incoming)
    {
        $nickname = $this->checkKey($incoming, self::KEY_NICKNAME);
        $cleanNickname = $this->cleaner->sanitize($nickname, \Security\cleaners\CleanerFactory::STRING);
        if(!empty($cleanNickname)){
            $this->checkUser();
            $this->user->setNickname($cleanNickname);
            return true;
        }
    }

    public function handleEmail(array $incoming)
    {
        $email = $this->checkKey($incoming, self::KEY_EMAIL);
        $cleanEmail = $this->cleaner->sanitize($email, \Security\cleaners\CleanerFactory::EMAIL);
        if (!empty($cleanEmail)) {
            $this->checkUser();
            $this->user->setEmail($email);
            return true;
        }
    }

    public function handleAge(array $incoming)
    {
        $age = $this->checkKey($incoming, self::KEY_AGE);
        $cleanAge = $this->cleaner->sanitize($age, \Security\cleaners\CleanerFactory::STRING);
        $cleanAge = trim($cleanAge);
        $dbAge = \AgeQuery::create()->filterByAge($age)->findOne();
        if (!empty($dbAge)) {
            $this->checkUser();
            $this->user->setAge($dbAge);
            return true;
        } else {
            throw new \Registration\errors\BadUserValueException("Bad age submitted");
        }
    }
//
//    public function handleRace(array $incoming)
//    {
//        $race = $this->checkKey($incoming, self::KEY_RACE);
//        foreach($race as $r)
//        {
//            $cr = $this->cleaner->sanitize($r, \Security\cleaners\CleanerFactory::STRING);
//            $dbRace = \RaceQuery::create()->filterByRace($cr)->findOne();
//            if(!empty($dbRace)){
//                array_push($this->userRaces, $dbRace);
//            }
//        }
//        return true;
//    }

    public function handleEthnicity(array $incoming, $conn=null)
    {
        $ethnicity = $this->checkKey($incoming, self::KEY_ETHNICITY);
        $race = $this->checkKey($incoming, self::KEY_RACE);
        $eth = $ethnicity + $race;
        foreach($eth as $e)
        {
            $ce = $this->cleaner->sanitize($e, \Security\cleaners\CleanerFactory::STRING);
            $dbEthnicity = \EthnicityQuery::create()->filterByEthnicity($ce)->findOne();
            if(!empty($dbEthnicity))
            {
                $ueq = \UserEthnicityQuery::create()->filterByUser($this->user)
                    ->filterByEthnicity($dbEthnicity)
                    ->findOneOrCreate();
                $ueq->save($conn);
            }
        }
        return true;
    }

    protected function checkKey($incoming, $expectedKey)
    {
        if (isset($incoming[$expectedKey]))
        {
            return $incoming[$expectedKey];
        }
        else {
            throw new BadUserValueException("$expectedKey not set in incoming array");
        }
    }

    /**
     * Checks if the user to be populated has been created
     * yet. If not, creates it.
     */
    protected function checkUser()
    {
        if (empty($this->user)) {
            $this->user = new \User();
        }
    }

}