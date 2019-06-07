<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;
use Staff\Models\Users;
use Staff\Roles\UserRole;
use Staff\Roles\ModelResource;

use Staff\Forms\SignUpUserForm;



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
      //  $user = Users::findFirst($this->auth['id'])->toArray();
       // $users = $this->userService->allUsers()->toArray();
       // array_unshift($users, $user);

        $user = Users::findFirst($this->auth['id'])->toArray();
        $users = $this->userService->allUsers()->toArray();
        foreach ($users as $k=>$item) {

            if($user['id'] == $item['id'])
                unset($users[$k]);
        }
       // print_die($user);
       // print_die($users);

        array_unshift($users, $user);


        $form = new SignUpUserForm();
        $authUser = $this->auth;

        $timeUserAuth = $this->day->resultTime($authUser);
        $times = $this->timeService->allTimes();
        $currentWeek = $this->day->weeksCurrentMouth();
        $users = $this->userService->getAllUsersByIdDesc();

        $this->view->auth = $this->auth;
        $this->view->totalResultTime = $timeUserAuth;
        $this->view->times = $times;
        $this->view->currentWeks = $currentWeek;
        $this->view->users = $users;


        $this->view->form = $form;

    }

    public function setstartAction()
    {

        $timeBool = $this->day->timeStart($this->auth);

        if($timeBool){
            return $this->response->redirect('index/index');
        }

    }

    public function setendAction()
    {

        $timeBool = $this->day->timeEnd($this->auth);

        if($timeBool){
            return $this->response->redirect('index/index');
        }

    }

}

