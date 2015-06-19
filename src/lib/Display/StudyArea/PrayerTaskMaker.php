<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/18/15
 * Time: 3:11 PM
 */

namespace Display\StudyArea;


use Scheduling\States\StateManager;

class PrayerTaskMaker extends StudyAreaMaker
{

    const DIV_ID = 'prayerTask';


    public $template;

    public function chooseTemplate($state)
    {
        switch ($state) {
            case StateManager::PRE_EXPERIMENT:
                $this->template = self::TEMPLATE_PRE_EXPERIMENT;
//                "studyarea.prayertask.preexperiment.twig";
                break;

            case StateManager::WAITLIST_AGENT:
                $this->template = self::TEMPLATE_WAITLIST_AGENT;
                //"studyarea.prayertask.waitlist.agent.twig";
                break;

                case StateManager::WAITLIST_PATIENT:
                        $this->template = self::TEMPLATE_WAITLIST_PATIENT;
                    //"studyarea.prayertask.waitlist.patient.twig";
                break;

            case StateManager::ACTIVE:
                $this->template = self::TEMPLATE_ACTIVE;
                //"studyarea.prayertask.active.twig";
                break;

            case StateManager::POST_EXPERIMENT:
                $this->template = self::TEMPLATE_POST_EXPERIMENT;
                //"studyarea.prayertask.postexperiment.twig";
                break;

            case StateManager::END:
                $this->template = self::TEMPLATE_PRE_EXPERIMENT;
                //"studyarea.prayertask.preexperiment.twig";
                break;

            default:
                throw new \Exception("invalid state requested");
        }
    }

    public function make()
    {
        $vars = array('mainContent' => $this->content_maker->make());
        $this->add_variables($vars);
        $this->setAreaDivId(self::DIV_ID);
        $this->render($this->template);
    }
}