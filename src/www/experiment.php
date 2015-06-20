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
$trial_id = 1;
$trial = \TrialQuery::create()->filterById($trial_id)->findOne();

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
        'inc/css/studyAreaStyles.css',
        'inc/css/painrate.questions.css',
        'inc/css/prayertask.css'
    ));
    $page_maker->makePageTopWithNavBar();

    $faker = \Faker\Factory::create();
    $userHash = $faker->sha256;

    # page body
    echo "<input type='hidden' id='userHash' value='$userHash' />";

//dummy for development
    $content_maker = new \Display\StudyArea\IContentMakerMock();

    # Pain assessment area
    $pain_content_getter = new \PainAssess\Display\PainAssessmentGetter();
    $pain_content_getter->setDao(new \PainAssess\dao\PainDao());
    $pain_content_getter->setTrial($trial);

    $pain_question_area_maker = new \Display\StudyArea\PainRatingMaker();
    $pain_question_area_maker->setContentMaker($pain_content_getter);
    $pain_question_area_maker->make();

    # Prayer task area
    $stages = [
        array('PRE_EXPERIMENT', StateManager::PRE_EXPERIMENT, StudyAreaMaker::TEMPLATE_PRE_EXPERIMENT),
        array('WAITLIST-agent', StateManager::WAITLIST_AGENT, StudyAreaMaker::TEMPLATE_WAITLIST_AGENT),
        array('WAITLIST-patient', StateManager::WAITLIST_PATIENT, StudyAreaMaker::TEMPLATE_WAITLIST_PATIENT),
        array('ACTIVE', StateManager::ACTIVE, StudyAreaMaker::TEMPLATE_ACTIVE),
        array('POST_EXPERIMENT', StateManager::POST_EXPERIMENT, StudyAreaMaker::TEMPLATE_POST_EXPERIMENT),
        array('END', StateManager::END, StudyAreaMaker::TEMPLATE_END)
    ];

    shuffle($stages);
    //dummy
    $stage = $stages[0][1];
    $stage = StateManager::WAITLIST_AGENT;

    $prayer_area_maker = new \Display\StudyArea\PrayerTaskMaker();
    $prayer_content_maker = new \Prayer\Display\PrayerGetter();
    $prayer_content_maker->setTrial($trial);
    $prayer_area_maker->setContentMaker($prayer_content_maker);
    $prayer_area_maker->chooseTemplate($stage);
    $prayer_area_maker->make();


    $scripts = <<< J
var scripts=["inc/js/index.js", "inc/js/painratings.js"];
J;

    $onload = <<< H
var onLoad = function(){
    painRatingsOnLoad();
    prayertaskOnLoad();
    console.log("onload fired");
    };
H;

    $page_maker->makePageBottom($scripts, $onload);
}