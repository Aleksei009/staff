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

        //print_die($this->auth);

        //$user = Profiles::find();

       // print_die($user);

       // $user = Users::findFirst(1);

       // print_die($user->getPermissions());
        //$permission = Permissions::find();

        //print_die($permission);

       // echo  $this->view->render('index/several');

        //print_die($ee);

        //$lates = $this->latesService->getLates();

       // print_die($lates);
       // print_die(date('Y-m'));

      //  $lates = Lates::find();
      //  print_die($lates);


        $form     = new SignUpUserForm();
        $authUser = $this->auth;

        $this->view->auth            = $authUser;
        $this->view->totalResultTime = $this->day->resultTime($authUser);
        $this->view->times           = $this->timeService->allTimes();
        $this->view->currentWeks     = $this->day->weeksCurrentMouth();
        $this->view->users           = $this->userService->sortUsers($authUser);
        $this->view->userAuthTimes   = $this->userService->getTimesForUser($authUser);
        $this->view->results         = $this->resultService->getAllResults();
        $this->view->i_am_late       = $this->timeService->amILateTime($this->auth);

        $this->view->form = $form;
       // $lates = $this->latesService->getLates();
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

