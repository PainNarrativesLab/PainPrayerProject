<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 4/5/15
 * Time: 1:27 PM
 */

namespace lib;

/**
 * Class MockParent
 * Parent for mock classes. All methods in mock classes should use something like:
            $this->record_call(__FUNCTION__, array($args));
            return $this->response;
 * @package lib
 */
class MockParent
{
    /** @var $response The response to return  */
    public $response;

    /** @var  $called The name of the last method called */
    public $called;

    public $called_list = array();

    /** @var $arguments array Array of last arguments given to method  */
    public $arguments = array();

    function __construct()
    {
        $this->response = TRUE;
    }

    /**
     * Records the call to the called_list array
     * @param $function_name String Usually easiest to input with __FUNCTION__
     * @param array $array_of_arguments
     */
    public function record_call($function_name=__FUNCTION__, $array_of_arguments)
    {
//        echo 'fun name:' . $function_name;
        $this->called = $function_name;
        $this->arguments = $array_of_arguments;
        array_push($this->called_list, array($function_name, $array_of_arguments));
    }

    public function __call($name, $arguments)
    {
        $this->record_call($name, $arguments);
        $this->called = $name;
        $this->arguments = $arguments;
        $this->$name($arguments);
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }
    public function set_response($response)
    {
        $this->response = $response;
    }

}