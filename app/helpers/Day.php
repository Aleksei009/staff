<?php


namespace Staff\Helpers;

use Staff\Models\Holidays;
use Staff\Models\Times;
use Staff\Models\Users;

class Day
{

    public  $months = [
        0 => [ 'month' => "January",'num' => 1, "date"=>'01'],
        1 => ['month' =>"February",'num' => 2, "date"=>'02'],
        2 => ['month' =>"March",'num' => 3, "date"=>'03'],
        3 => ['month' =>"April",'num' => 4, "date"=>'04'],
        4 =>  ['month' =>"May",'num' => 5, "date"=>'05'],
        5  => ['month' =>"June",'num' => 6, "date"=>'06'],
        6  => ['month' =>"July",'num' => 7, "date"=>'07'],
        7  => ['month' =>"August",'num' => 8, "date"=>'08'],
        8 => ['month' =>"September",'num' => 9, "date"=>'09'],
        9 =>  ['month' =>"October",'num' => 10, "date"=>'10'],
        10 =>  ['month' =>"November",'num' => 11, "date"=>'11'],
        11 => ['month' =>"December",'num' => 12, "date"=>'12']
    ];

    public  $years = [0 => ['year' => 2018,'num' => 1],1 => ['year'=>'2019','num' => 2]];

    public function resultTime($authUser)
    {
        $user = Users::findFirst($authUser['id']);
        $times = $user->getTimes();
        $resulTime = strtotime("03:00:00");
        $result = null;

        foreach ($times as $time){

            if($time->current_date == date('Y-m-d')){
                $result += strtotime($time->time_end) - strtotime($time->time_start);
            }
        }

        $result = date('H:i:s',$result - $resulTime);

        return $result;
    }

    public function weeksCurrentMouth($request = null)
    {
        /*$dayofmonth = date('t');
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

        return $weeks_current_month;*/

        if(isset($request['month']) && $request['month'] && $request['year']){
            $data = $request;
        }else{
            $data = ["month" => (date('m')),"year" => (date('Y'))];
        }

        $curMount = strtotime('01'.'-'.$data['month'].'-'.$data['year']);

        $current_year = date("Y",$curMount);
        $current_mouth = date("m",$curMount);
        $dayofmonth = date('t',$curMount);

        $weeks_current_month = [];

        for ($i = 1; $i <= $dayofmonth; $i++){

            $weeks_current_month[$i]= [
                'day' => $i,
                'week' => date('l', strtotime($current_year.'-'.$current_mouth.'-'.$i)),
                'year' => date('Y-m-d', strtotime($current_year.'-'.$current_mouth.'-'.$i))
            ];
        }
        return  $weeks_current_month;


    }

    public function timeStart($authUser){


        $current_date = date("Y-m-d");
        $user = Users::findFirst($authUser['id']);

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

            if($timeS){
                if($timeS->i_am_late == 0){
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
            }

        }

    }

    public function correctDay($id)
    {
        $time = Times::findFirst([
            'conditions' => 'current_date= :date: AND user_id = :user_id: AND i_am_late = :i_am_late: ORDER BY time_start',
            'bind' => [
                'date' => date('Y-m-d'),
                'user_id' => $id,
                'i_am_late' => 1
            ]
        ]);
        if($time){
            $time->i_am_late = 0;
            return $time->save();
        }

    }

    public function countDayCurrentMonth($request = null)
    {
        $holidays = Holidays::find();

        $i = 0;
        $currentMonth = $this->weeksCurrentMouth($request);

        foreach ($currentMonth as $item){

            foreach ($holidays as $day){
                if ($day->date == $item['year']){
                    $i--;
                }
            }
            if(!$item['week'] == 'Saturday' or $item['week'] == 'Sunday'){
                $i--;
            }else{
                $i++;
            }
        }
        return $i;
    }

    public function parse_timestamp($t = 0)
    {
        $month = floor($t / 2592000);
        $day = ($t / 86400) % 30;
        $hour = ($t / 3600) % 24;
        $min = ($t / 60) % 60;
        $sec = $t % 60;

        return ['month' => $month, 'day' => $day, 'hour' => $hour, 'min' => $min, 'sec' => $sec];
    }

    public function getDate($time)
    {
        $hours = floor($time / 3600);
        $minutes = ($time / 3600 - $hours) * 60;
        $seconds = ceil(($minutes - floor($minutes)) * 60);

        return ['hour' => $hours,'minutes' => floor($minutes),'seconds' => $seconds];
    }

    public function getResultforDate($auth)
    {

        $times = Times::find([
            'conditions' => 'current_date <= :current_date: AND current_date >= :minDate: and user_id = :user_id:',
            'bind' => [
                'current_date' => '2019-06-30',
                'minDate' => '2019-06-01',
                'user_id' => $auth['id']
            ]
        ])->toArray();

        $miliSecond = 0;
        foreach ($times as $time) {

            if ($time['time_end'] != null){
                $miliSecond += strtotime($time['current_date'].' '.$time['time_end']) - strtotime($time['current_date'].' '.$time['time_start']);
            }
        }

        $resultTime = $this->getDate($miliSecond);

        return $resultTime;

    }

    public function resultForCountTime($request = null)
    {
        $day = $this->countDayCurrentMonth($request);

        $hourWork = $day * 8;

        //$result = $hourWork - $resultUser['hour'];


        return $hourWork;
    }

    function getPercentOfNumber($number, $percent){
        return ($percent / 100) * $number;
    }

    public function getDateResult($auth,$request)
    {
        if (isset($request['year']) && isset($request['month'])){

            $times = Times::find([
                'conditions' => 'current_date <= :current_date: AND current_date >= :minDate: and user_id = :user_id:',
                'bind' => [
                    'current_date' => $request['year'].'-'.$request['month'].'-30',
                    'minDate' => $request['year'].'-'.$request['month'].'-01',
                    'user_id' => $auth['id']
                ]
            ])->toArray();
        }else{

            $times = Times::find([
                'conditions' => 'current_date <= :current_date: AND current_date >= :minDate: and user_id = :user_id:',
                'bind' => [
                    'current_date' => '2019-06-30',
                    'minDate' => '2019-06-01',
                    'user_id' => $auth['id']
                ]
            ])->toArray();
        }


        $miliSecond = 0;
        foreach ($times as $time) {

            if ($time['time_end'] != null){
                $miliSecond += strtotime($time['current_date'].' '.$time['time_end']) - strtotime($time['current_date'].' '.$time['time_start']);
            }
        }

        $resultTime = $this->getDate($miliSecond);

        return $resultTime;

    }



}