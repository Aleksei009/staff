<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;
use Staff\Models\Results;
use Staff\Models\Times;
use Staff\Roles\UserRole;
use Staff\Roles\ModelResource;

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

       // $i_am_late = $this->timeService->amILateTime($this->auth);
       // print_die($i_am_late);

       // print_die($results);

        $form     = new SignUpUserForm();
        $authUser = $this->auth;


        $timeUserAuth  = $this->day->resultTime($authUser);
        $times         = $this->timeService->allTimes();
        $currentWeek   = $this->day->weeksCurrentMouth();
        $users         = $this->userService->sortUsers($authUser);
        $userAuthTimes = $this->userService->getTimesForUser($authUser);
        $results       = $this->resultService->getAllResults();
        $i_am_late     = $this->timeService->amILateTime($this->auth);

       // print_die($results);

        $this->view->auth            = $this->auth;
        $this->view->totalResultTime = $timeUserAuth;
        $this->view->times           = $times;
        $this->view->currentWeks     = $currentWeek;
        $this->view->users           = $users;
        $this->view->userAuthTimes   = $userAuthTimes;
        $this->view->results         = $results;
        $this->view->i_am_late       = $i_am_late;


        $this->view->form = $form;

        //print_die($i_am_late);
    }

    public function setstartAction()
    {

        $timeBool = $this->day->timeStart($this->auth);

        if($timeBool){
            return $this->response->redirect('index/index');
        }else{
            return $this->response->redirect('index/index');
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
            return $this->response->redirect('index/index');
        }else{
            return $this->response->redirect('index/index');
        }

    }

}

