<?php


namespace Staff\Helpers;

use Staff\Models\Times;
use Staff\Models\Users;

class Day
{

    public function resultTime($authUser)
    {
        $user = Users::findFirst($authUser['id']);
        $times = $user->getTimes();
        $resulTime = strtotime("03:00:00");
        $result = null;

        foreach ($times as $time){

            $result += strtotime($time->time_end) - strtotime($time->time_start);
        }

        $result = date('H:i:s',$result - $resulTime);

        return $result;
    }

    public function weeksCurrentMouth()
    {
        $dayofmonth = date('t');
        $current_year = date("Y");
        $current_mouth = date("m");

        $weeks_current_month = [];

        for ($i = 1; $i <= $dayofmonth; $i++){

            $weeks_current_month[$i]= [
                'day' => $i,
                'week' => date('l', strtotime($current_year.'-'.$current_mouth.'-'.$i)),
                'year' => date('Y-m-d', strtotime($current_year.'-'.$current_mouth.'-'.$i))
            ];
        }

        return $weeks_current_month;

    }

    public function timeStart($authUser){


        $current_date = date("Y-m-d");
        $user = Users::findFirst($authUser['id']);

        $times = $user->getTimes();

        $today = date("H:i",strtotime("+4 hour"));

        $i_am_late = null;

        if($user->getTimes()->toArray() != false){
            $timeS = Times::findFirst([
                'conditions' => 'current_date= :date: AND user_id= :user_id: ORDER BY time_start',
                'bind' => [
                    'date' => date('Y-m-d'),
                    'user_id' => $user->id
                ]
            ]);

            foreach ($times as $time){

                if($time->current_date == $current_date && $time->user_id == $user->id && $timeS < 9){
                    $i_am_late = 1;

                }else{
                    $i_am_late = 0;
                }
            }
        }else{
            $i_am_late = ($today < 9) ? 0 : 1;
        }

        $dateNull = null;

        $time = new Times([
            'time_start' => $today,
            'time_end' => $dateNull,
            'current_date' => $current_date,
            'user_id' => $authUser['id'],
            'active' => 1,
            'i_am_late' => $i_am_late

        ]);
        return $time->save();

    }

    public function timeEnd($userAuth)
    {
        $today = date("H:i",strtotime("+4 hour"));
        $user = Users::findFirst( $userAuth['id']);
        $times = $user->getTimes();

        foreach ($times as $time){

            if($time->time_end == null && $time->active == 1){

                $time->time_end = $today;
                $time->active = 0;
                return $time->save();
                break;
                /*if($time->save()){
                    return $this->response->redirect('index/index');
                }*/
            }

        }

    }

}