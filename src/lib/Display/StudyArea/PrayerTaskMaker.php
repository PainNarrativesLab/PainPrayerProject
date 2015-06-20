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

    const DATA_ARRAY_KEY = 'mainContent';

    public $template;

    public function chooseTemplate($state)
    {
        switch ($state) {
            case StateManager::PRE_EXPERIMENT:
                $this->template = self::TEMPLATE_PRE_EXPERIMENT;
                break;

            case StateManager::WAITLIST_AGENT:
                $this->template = self::TEMPLATE_WAITLIST_AGENT;
                break;

                case StateManager::WAITLIST_PATIENT:
                        $this->template = self::TEMPLATE_WAITLIST_PATIENT;
                break;

            case StateManager::ACTIVE:
                $this->template = self::TEMPLATE_ACTIVE;
                break;

            case StateManager::POST_EXPERIMENT:
                $this->template = self::TEMPLATE_POST_EXPERIMENT;
                break;

            case StateManager::END:
                $this->template = self::TEMPLATE_END;
                break;

            default:
                throw new \Exception("invalid state requested");
        }
    }

    public function make()
    {
        $vars = $this->content_maker->getContent();
        $this->add_variables($vars);
        $this->setAreaDivId(self::DIV_ID);
        $this->render($this->template);
    }
}