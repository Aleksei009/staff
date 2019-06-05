<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;

use Staff\Models\NowDates;
use Staff\Roles\UserRole;
use Staff\Roles\ModelResource;

use Staff\Forms\SignUpForm;
use Staff\Forms\UsersForm;
use Staff\Forms\SignInForm;
use Staff\Forms\SignUpUserForm;

use Staff\Models\Users;
use Staff\Models\Times;
use Staff\Models\Blogs;

use Staff\Services\UserService;


class IndexController extends ControllerBase
{

    public function initialize()
    {

        /*if($this->session->get('auth')){

            $this->view->setTemplateBefore('main-public');

        }else{

            if($this->session->get('role') == 'admin'){

                $this->view->setTemplateBefore('main-private-admin');
            }

            if($this->session->get('role') == 'user'){

                $this->view->setTemplateBefore('main-private-user');
            }

        }

        $this->view->setTemplateBefore('index');*/


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
        $dayNowMouth = date('t');

        $day = '25';
        $month = date('m', time());
        $year = date('Y', time());



        $day_of_week = strtotime($month.'/'.$day.'/'.$year);

       // print_die($day_of_week);

       // print_die($this->session->get('auth'));
       // print_die(date("H:i:s"));

        //$times = Times::findFirst(1);

       // print_die($times->getUser());


        //print_die($times);

        /*$user = Users::findFirst(125);

        print_die($user->getTimes()->toArray());*/

        //print_die($user->initialize());

        // print_die($user);


        if($this->session->has('auth')){

            $auth = $this->session->get('auth');
            $this->view->auth = $auth;
            //print_die($auth);

        }

       // print_die($this->session->get('auth'));

      //  print_die($this->session->get('auth')['role'] == 'user');

        //print_die($this->session->get('auth')['role']);

       /* if(!$this->session->get('auth')){

            return $this->response->redirect('')
        }*/

       // $startSession = $session->set('name','Alseksei');


        /*$this->session->set('auth',[
            'role' => 'admin',
            'name' => 'aleksei',
            'email' => 'aleksei@mail.ru'
        ]);

        print_die($this->session->get('auth'));*/

        /*$users = Users::find();

        $data = null;*/


        //print_die($data);

        /*$acl = new AclList();
        $acl->setDefaultAction(
                Acl::DENY
        );

        $roleAdmins = new Role('Administrators', 'Super-UserRepository role');
        $roleGuests = new Role('Guests');

        $acl->addRole($roleGuests);

        $acl->addRole('Designers');

        $customersResource = new Resource('Articles');

         $acl->addResource(
            $customersResource,
            'search'
        );

        $acl->addResource(
            $customersResource,
            [
                'create',
                'update',
            ]
        );

        $acl->allow('Guests', 'Articles', 'search');
        $acl->allow('Guests', 'Articles', 'create');
        $acl->allow('Guests', 'Articles', 'update');

        $result = $acl->isAllowed('Guests', 'Articlesss', 'update');

        print_die($result);*/

       // print_die($result);

       /* $acl->addResource(
            $customersResource,
            [
                'create',
                'update',
            ]
        );*/


        $users = Users::find([
            'order' => 'id DESC'
        ]);
        $this->view->users = $users;


        $form = new SignUpUserForm();
        /*if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password'))
                ]);
                /*if ($user->save()) {
                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
                $this->flash->error($user->getMessages());
            }
        }*/

       /* if($form->isValid($this->request->getPost()) != false){


        }*/

        $this->view->form = $form;

    }

    public function signInAction()
    {
        $form = new SignInForm();
        $this->view->form = $form;

    }

    public function savedateAction()
    {

    }

    public function setstartAction()
    {

       /* $blog = new Blogs();

        $blog->save(['title' => 'main-title']);*/



        //print_die(date("Y-m-d"));

        $current_date = date("Y-m-d");
        $today = date("H:i");
        $dateNull = null;

       // print_die($today);

       // print_die($this->session->get('auth'));

        $user = Users::findFirst($this->session->get('auth')['id']);



       $time = new Times([
           'time_start' => $today,
           'time_end' => $dateNull,
           'current_date' => $current_date,
           'user_id' => $this->session->get('auth')['id'],
           'active' => 1

       ]);

      // $time->id = 1;
       /*$time->time_start = $today;
       $time->time_end = $today;
       $time->current_date = $current_date;*/
       //$time->setUser(1);

      // print_die($time);

        //print_die($time->save());

       // $time->save());
       if($time->save()){
           return $this->response->redirect('index/index');
       }

      // print_die($time);


       // return $this->response->redirect('index/index');
    }

    public function setendAction()
    {

        $user = $this->session->get('auth');
        $today = date("H:i");
        //print_die($user);
       // $time = Times::findFirst(7);
        $times = Times::find();

        //$time->time_end = $today;

      //  print_die($time->save());

       // print_die($times->toArray());


        foreach ($times as $time){

           if($time->time_end == null && $time->active == 1){

               $time->time_end = $today;
               $time->active = 0;
               if($time->save()){
                   return $this->response->redirect('index/index');
               }

           }

           // print_die($time->user_id);
            //print_die($user['id']);

          //  print_die($time->user_id == $user['id']);

           /* if($time->user_id == $user['id']){

                if($time->time_end == null && $time->active == 1)

                    $time->time_end = $today;
                    print_die($time->update());

            }


           print_die($time->getUser());*/
        }

    }

}

