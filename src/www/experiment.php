<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/24/15
 * Time: 1:36 PM
 */
require_once('filemaster.php');

use Display\StudyArea\StudyAreaMaker;
use Scheduling\States\StateManager;

$username = 'test name';
$page_title = "Pain and spirituality study";

//check incoming hash and get records
$link_valid = true;
//$link_valid = false;

if($link_valid === false)
{
    $error = new \TemplateClasses\ErrorMessages();
    $error->link_expired();
}else
{

//ready to make page
//TODO: Add something to send header here
    $page_maker = new \TemplateClasses\PageMaker();
    $page_maker->setPageName($page_title);
    $page_maker->add_variables(array('nickname' => $username));
    $page_maker->addStyleSheets(array(
        'inc/css/experimentStyles.css',
        'inc/css/footerStyles.css',
        'inc/css/topBarStyles.css',
        'inc/css/studyAreaStyles.css'
    ));
    $page_maker->makePageTopWithNavBar();

//dummy for development
    $content_maker = new \Display\StudyArea\IContentMakerMock();

    $pain_question_area_maker = new \Display\StudyArea\PainRatingMaker();
    $pain_question_area_maker->setContentMaker($content_maker);
    $pain_question_area_maker->make();
    $stages = [
        array('PRE_EXPERIMENT', StateManager::PRE_EXPERIMENT, StudyAreaMaker::TEMPLATE_PRE_EXPERIMENT),
        array('WAITLIST-agent', StateManager::WAITLIST_AGENT, StudyAreaMaker::TEMPLATE_WAITLIST_AGENT),
        array('WAITLIST-patient', StateManager::WAITLIST_PATIENT, StudyAreaMaker::TEMPLATE_WAITLIST_PATIENT),
        array('ACTIVE', StateManager::ACTIVE, StudyAreaMaker::TEMPLATE_ACTIVE),
        array('POST_EXPERIMENT', StateManager::POST_EXPERIMENT, StudyAreaMaker::TEMPLATE_POST_EXPERIMENT),
        array('END', StateManager::END, StudyAreaMaker::TEMPLATE_END)
    ];

    foreach ($stages as $s) {
        $prayer_area_maker = new \Display\StudyArea\PrayerTaskMaker();
        $prayer_area_maker->setContentMaker($content_maker);
        echo "<br/>" . $s[0] . "<br/>";
        $prayer_area_maker->chooseTemplate($s[1]);
        $prayer_area_maker->make();
        echo "<br/> -----------<br/>";
    }


    $scripts = <<< J
var scripts=["inc/js/index.js"];
J;

    $onload = <<< H
var onLoad=function(){console.log("onload fired");};
H;

    $page_maker->makePageBottom($scripts, $onload);
}