<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;
use Staff\Models\Holidays;
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
        $lateUser = Lates::findFirst([
            'conditions' => 'user_id = :user_id: and current_month = :current_month:',
            'bind' => [
                'user_id' => $this->auth['id'],
                'current_month' => (date('Y-m'))
            ]
        ]);

        $timeLate = Times::findFirst([
            'conditions' => 'user_id = :user_id: and current_date = :current_date: and i_am_late = :i_am_late:',
            'bind' => [
                'user_id' => $this->auth['id'],
                'current_date' => (date('Y-m-d')),
                'i_am_late' => 1
            ]
        ]);

        if ($lateUser){

            $late = Lates::findFirst($lateUser->id);

            if ($timeLate && $late->update_at != (date('Y-m-d'))){
                $late->count_lates += 1;
                $late->update_at = date('Y-m-d');
            }else{
                $late->count_lates += 0;
            }
            $late->save();
        }else{

            $late = new Lates();
            if ($timeLate){
                $late->count_lates +=1;
            }else{
                $late->count_lates +=0;
            }

            $late->user_id = $this->auth['id'];
            $late->current_month = date('Y-m');
            $late->update_at = date('Y-m-d');
            $late->save();
        }



        $getData = $this->request->get();

        if($this->request->isGet() && isset($this->request->get()['month']) && $this->request->get()['month'] && $this->request->get()['year']){
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

        $form     = new SignUpUserForm();
        $authUser = $this->auth;

        //$resultTimeR = $this->day->getResultforDate($this->auth);
        $resultTimeR = $this->day-> getDateResult($this->auth,$this->request->get());;
        $allCount = $this->day->resultForCoutTime($resultTimeR);
        $latesForMe = Lates::findFirst([
            'conditions' => 'user_id = :user_id: and current_month = :current_month:',
                'bind' => [
                    'user_id' => $this->auth['id'],
                    'current_month' => date('Y-m')
                ]
            ]);

        $procent = number_format((($resultTimeR['hour'] * 100) / $allCount), 2, '.', '') ;



        $this->view->auth            = $authUser;
        $this->view->totalResultTime = $this->day->resultTime($authUser);
        $this->view->times           = $this->timeService->allTimes();
        $this->view->currentWeks     = $weeks_current_month;
        $this->view->users           = $this->userService->sortUsers($authUser);
        $this->view->userAuthTimes   = $this->userService->getTimesForUser($authUser);
        $this->view->results         = $this->resultService->getAllResults();
        $this->view->i_am_late       = $this->timeService->amILateTime($this->auth);
        $this->view->latesUsers      = $this->latesService->getLates();
        $this->view->months          = $this->day->months;
        $this->view->years           = $this->day->years;
        $this->view->getData         =  $getData;
        $this->view->resultTimeR     =  $resultTimeR;
        $this->view->resultTimeUser  =  $allCount;
        $this->view->procent         =  $procent;
        $this->view->latesForMe      = $latesForMe;

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
            return $this->response->redirect('index');
        }else{
            return $this->response->redirect('index');
        }

    }


}

