<?php

/*
 * Gradeomatic
 * Copyright Adam Swenson Merp Co Intl
 *
 */

namespace Security\logging;

/**
 * Description of ISecurityLoggersMock
 *
 * @author adam
 */
class ISecurityLoggersMock extends \lib\MockParent implements ISecurityLoggers
{
    public $logged = '';
    public function criticalEvent($to_log)
    {
        $this->logged = $to_log;
    }

    public function infoEvent($to_log)
    {
        $this->logged = $to_log;
    }

    public function securityEvent($to_log)
    {
        $this->logged = $to_log;
    }

}
