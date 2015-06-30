<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/29/15
 * Time: 4:07 PM
 */

namespace Registration;


use Registration\errors\BadUserValueException;

class RegistrationManager
{

    public $userAdder;
    public $notificationManager;

    /**
     * @param mixed $userAdder
     */
    public function setUserAdder($userAdder)
    {
        $this->userAdder = $userAdder;
    }

    /**
     * @param mixed $notificationManager
     */
    public function setNotificationManager($notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    public function handle(\RequestHandling\IRequest $request)
    {
        $this->userAdder->addUser($request);
    }
}