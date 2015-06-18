<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 5/24/15
 * Time: 1:36 PM
 */
require_once('filemaster.php');

$username = 'test name';
$page_title = "Pain and spirituality study";

$page_maker = new \TemplateClasses\PageMaker();
$page_maker->setPageName($page_title);
$page_maker->add_variables(array('nickname' => $username));
$page_maker->addStyleSheets(array('inc/css/experimentStyles.css', 'inc/css/footerStyles.css', 'inc/css/topBarStyles.css', 'inc/css/studyAreaStyles.css'));
$page_maker->makePageTopWithNavBar();

//dummy for development
$content_maker = new \Display\StudyArea\IContentMakerMock();

$pain_question_area_maker = new \Display\StudyArea\PainRatingMaker();
$pain_question_area_maker->setContentMaker($content_maker);
$pain_question_area_maker->make();

$prayer_area_maker = new \Display\StudyArea\PrayerTaskMaker();
$prayer_area_maker->setContentMaker($content_maker);
$prayer_area_maker->make();
?>



<?php
$scripts = <<< J
var scripts=["inc/js/index.js"];
J;

$onload = <<< H
var onLoad=function(){console.log("onload fired");};
H;

$page_maker->makePageBottom($scripts, $onload);