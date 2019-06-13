<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;
use Staff\Models\Permissions;
use Staff\Models\Profiles;
use Staff\Models\Results;
use Staff\Models\Times;
use Staff\Models\Users;
use Staff\Roles\UserRole;
use Staff\Roles\ModelResource;
use Staff\Models\Lates;

use Staff\Forms\SignUpUserForm;
use Staff\Services\ResultService;


class IndexController extends ControllerBase
{

    public function initialize()
    {

        parent::initialize();

        if($this->session->has('auth')){

            if($this->session->get('auth')['role'] == 'admin'){

                $this->view->setTemplateBefore('main-private-admin');
            }

            if($this->session->get('auth')['role'] == 'user'){

                $this->view->setTemplateBefore('main-private-user');
            }

        }else{

            $this->view->setTemplateBefore('form-register');

        }


    }

    public function indexAction()
    {


        $resultTimeR = $this->day->getResultforDate($this->auth);
        //print_die($resultTime);
        $resultTimeUser = $this->day->resultForCoutTime($resultTimeR);


        //print_die($resultTimeR);



        /*public function parse_timestamp($t = 0)
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

            echo $hours . " : " . floor($minutes) . " : " . $seconds;
        }*/



        //Задача узнать как можно складывать время как Это все сделать;
        //И просто протесть это




        $getData = $this->request->get();


        if($this->request->isGet() && $this->request->get()['month'] && $this->request->get()['year']){
            $data = $this->request->get();
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

       // print_die($weeks_current_month);


        $form     = new SignUpUserForm();
        $authUser = $this->auth;

        $this->view->auth            = $authUser;
        $this->view->totalResultTime = $this->day->resultTime($authUser);
        $this->view->times           = $this->timeService->allTimes();
        //$this->view->currentWeks     = $this->day->weeksCurrentMouth();
        $this->view->currentWeks     = $weeks_current_month;
        $this->view->users           = $this->userService->sortUsers($authUser);
        $this->view->userAuthTimes   = $this->userService->getTimesForUser($authUser);
        $this->view->results         = $this->resultService->getAllResults();
        $this->view->i_am_late       = $this->timeService->amILateTime($this->auth);
        $this->view->months          = $this->day->months;
        $this->view->years           = $this->day->years;
        $this->view->getData         =  $getData;
        $this->view->resultTimeR     =  $resultTimeR;
        $this->view->resultTimeUser  =  $resultTimeUser;

        $this->view->form = $form;
    }

    public function setstartAction()
    {

        $timeBool = $this->day->timeStart($this->auth);

        if($timeBool){
            return $this->response->redirect('index');
        }else{
            return $this->response->redirect('index');
        }

    }

    public function setendAction()
    {

        $timeBool = $this->day->timeEnd($this->auth);

        if($timeBool){
            $resultTimeUser = $this->day->resultTime($this->auth);

            $current_date = date('Y-m-d');

             $this->resultService->saveAndUpdateCurrentResultTime([
                 'date' => $current_date,
                 'result_time' => $resultTimeUser,
                 'user_id' => $this->auth['id']
             ],$this->auth);
        }


        if($timeBool){
           // return $this->response->redirect('index/index');
            return $this->response->redirect('index');
        }else{
            return $this->response->redirect('index');
        }

    }

    public function tableAction()
    {

    }

}

