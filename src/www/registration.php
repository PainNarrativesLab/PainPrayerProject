<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 10:16 AM
 */

require_once('filemaster.php');
//require_once __DIR__.'/vendor/autoload.php';

$page_title = "Registration | Pain and spirituality study";

$page_maker = new \TemplateClasses\PageMaker();
$page_maker->setPageName($page_title);

$page_maker->makePageTop();
?>

<div>Main body text</div>

<?php
$scripts = <<< J
var scripts=["inc/js/index.js"];
J;

$onload = <<< H
var onLoad=function(){console.log("onload fired");};
H;

$page_maker->makePageBottom($scripts, $onload);