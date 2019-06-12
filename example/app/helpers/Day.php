<?php


namespace Staff\Helpers;

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

    public function countDayCurrentMonth()
    {
        $i = 0;
       $currentMonth = $this->weeksCurrentMouth();

       foreach ($currentMonth as $item){

           if(!$item['week'] == 'Saturday' or $item['week'] == 'Sunday'){
               $i--;
           }else{
               $i++;
           }
       }
       return $i;

    }

}