<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:51 AM
 */

namespace Tasks\Assignments\service;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class PartnershipLoader
 * Service class used to retrieve assigned partnerships
 * @package Tasks\Assignments\service
 */
class PartnershipLoader
{
    const HASH_LENGTH = 40;

    const IDENTIFIER_USER = 100;

    const IDENTIFIER_HASH = 101;

    public $partnership;

    protected $type;

    /** var $dao  \Tasks\Assignments\dao\IPartnershipDao */
    protected $dao;

    /**
     * @param \Tasks\Assignments\dao\IPartnershipDao $dao
     */
    public function setDao(\Tasks\Assignments\dao\IPartnershipDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param $identifier \User|string
     * @param null $date
     */
    public function load($identifier, $date = null)
    {
        $this->chooseMethod($identifier);
        $this->doLoad($identifier, $date);
        return $this->partnership;
    }

    /**
     * Handles the actual loading. Results get stored in $this->partnership
     * @param $identifier
     * @param null $date
     * @throws \Exception
     */
    protected function doLoad($identifier, $date = null)
    {
        if (empty($this->type)) {
            throw new \Exception("no type set");
        }
        switch ($this->type) {
            case self::IDENTIFIER_USER:
                $this->partnership = $this->dao->loadByAgentAndDate($identifier, $date);
                break;
            case self::IDENTIFIER_HASH:
                $this->partnership = $this->dao->loadByHash($identifier);
                break;
            default:
                throw new \Exception("invalid type was set");
        }
    }

    /**
     * The public facing method allows multiple ways of
     * loading a partnership assignment. The method figures out which
     * one to use.
     * It sets $this->type to the correct flag. It does not do the actual
     * load (so that if the arguments for load() change, this won't
     * have to be updated).
     */
    public function chooseMethod($identifier)
    {
        switch ($identifier) {
            case $this->checkIfUser($identifier):
                $this->type = self::IDENTIFIER_USER;
                break;
            case $this->checkIfHash($identifier):
                $this->type = self::IDENTIFIER_HASH;
                break;
            default:
                throw new \Exception("Invalid identifier passed in");
        }
    }

    /**
     * Determines if the identifier is a user
     * @param $identifier
     * @return bool
     */
    public function checkIfUser($identifier)
    {
        if ($identifier instanceof \User) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfHash($identifier)
    {
        if (ctype_alnum($identifier) && (mb_strlen(trim($identifier)) === self::HASH_LENGTH)) {
            return true;
        } else {
            return false;
        }
    }
}