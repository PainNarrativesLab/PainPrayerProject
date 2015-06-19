<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 2:34 PM
 */

namespace Display\StudyArea;


use \TemplateClasses\Controller;

abstract class StudyAreaMaker extends Controller
{

    const BASE_TEMPLATE = 'studyarea.base.twig';

    const AREA_DIV_ID_VAR = 'studyAreaId';

    const TEMPLATE_PAIN_RATINGS = 'studyarea.painquestions.checkboxes.twig';

    const TEMPLATE_PRE_EXPERIMENT = "studyarea.prayertask.preexperiment.twig";

    const TEMPLATE_WAITLIST_AGENT = "studyarea.prayertask.waitlist.agent.twig";
    const TEMPLATE_WAITLIST_PATIENT = "studyarea.prayertask.waitlist.patient.twig";
    const TEMPLATE_ACTIVE = "studyarea.prayertask.active.twig";
    const TEMPLATE_POST_EXPERIMENT = "studyarea.prayertask.postexperiment.twig";
    const TEMPLATE_END = "studyarea.prayertask.endexperiment.twig";


    /**
     * @var $content_maker \Display\StudyArea\IContentMaker Returns the content for mainContent on calling make()
     */
    protected $content_maker;

    /**
     * @param mixed $content_maker
     */
    public function setContentMaker(\Display\StudyArea\IContentMaker $content_maker)
    {
        $this->content_maker = $content_maker;
    }

    /**
     * Sets the id of the outermost studyArea div
     * @param $div_id string
     */
    public function setAreaDivId($div_id)
    {
        $this->add_variables(array(self::AREA_DIV_ID_VAR => $div_id));
    }

    abstract public function make();


    public function __construct()
    {
        parent::__construct();
    }
}