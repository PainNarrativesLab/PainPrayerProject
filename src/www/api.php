<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/19/15
 * Time: 2:51 PM
 */

$task = 'recordPainRating';

switch($task){
    case "recordPainRating":
        echo json_encode(array("status" => "success"));
    break;

    case "recordPrayer":
        echo json_encode(array("status" => "success"));
    break;
}