<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 6/20/15
 * Time: 9:47 AM
 */

namespace Tasks\Assignments\service;


class IHashMakerMock extends \lib\MockParent implements IHashMaker
{

    public function makeHash()
    {
        $this->record_call(__FUNCTION__, array());
        return $this->response;
    }
}