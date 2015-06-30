<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/29/15
 * Time: 5:22 PM
 */

namespace Registration\errors;


class BadUserValueException extends \Exception
{
    public function __construct($message = null, $code = 0, \Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}