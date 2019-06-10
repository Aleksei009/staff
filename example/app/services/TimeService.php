<?php


namespace Staff\Services;

use Staff\Services\MainService;

use Staff\Models\Times;

class TimeService extends MainService
{

    public function allTimes()
    {
        $times = Times::find()->toArray();
        return $times;
    }

    public function amILateTime($auth)
    {


        $time = Times::findFirst([
            'conditions' => 'current_date = :date: AND user_id = :user_id: and i_am_late = :i_am_late:',
            'bind' => [
                'date' => date('Y-m-d'),
                'user_id' => $auth['id'],
                'i_am_late' => 1

            ]
        ]);

        if($time){
            return $time->toArray();
        }else{
            return [];
        }



    }
}