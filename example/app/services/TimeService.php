<?php


namespace Staff\Services;

use Staff\Services\MainService;

use Staff\Models\Times;

class TimeService extends MainService
{

    public function allTimes()
    {
        $times = Times::find();
        return $times;
    }

}