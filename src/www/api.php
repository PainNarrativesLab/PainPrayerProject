<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 2:51 PM
 */

require_once("filemaster.php");
try {
    $request = \RequestHandling\Request::create();

    switch ($request->task()) {
        case \RequestHandling\Request::REGISTER:
            echo json_encode(array("status" => "success"));
            break;

        case \RequestHandling\Request::RECORD_PAIN:
            echo json_encode(array("status" => "success"));
            break;

        case \RequestHandling\Request::RECORD_PRAYER:
            echo json_encode(array("status" => "success"));
            break;

        default:
            throw new \Exception("Illegal task request");
    }
}catch (\Exception $e){
    echo json_encode(array("status" => "fail"));
    throw $e;
}