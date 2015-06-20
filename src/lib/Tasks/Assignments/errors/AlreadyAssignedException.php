<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 10:13 AM
 */

namespace Tasks\Assignments\errors;


class AlreadyAssignedException extends \Exception
{

    public function __construct($message = null, $code = 0, \Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }

}