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

      /*  $time = Times::findFirst(83);

        $timeEnd = strtotime($time->time_end);
        $timeStr = strtotime($time->time_start);


        print_die(date('H:i:s',strtotime($timeEnd - $timeStr)));*/


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

        //times

        $times = Times::find();

      /* // print_die($times->toArray());
        $totalTime = null;
        $currentTime = null;
        foreach ($times as $time){

           // print_die($time->user_id  == $this->session->get('auth')['id']);

            if($time->user_id == $this->session->get('auth')['id']){

                $timeStr = strtotime(date($time->time_start));
                $timeEnd = strtotime(date($time->time_end));

                print_die(date('H:i:s',$timeStr-$timeEnd));

                $currentTime += $timeStr + $timeEnd;

            }
        }

       // print_die($currentTime);

        $totalTime = date('H:i:s',$currentTime);
        //print_die($totalTime);
        $this->view->totalTimeAuthUser = $totalTime;*/

        $this->view->times = $times;

        $users = Users::find();

        $this->view->users = $users;
        $this->view->currentWeks = $weeks_current_month;


        if($this->session->has('auth')){

            $auth = $this->session->get('auth');
            $this->view->auth = $auth;

        }



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

        print_die($result);

        print_die($result);

        $acl->addResource(
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

        $this->view->form = $form;



    }

    public function setstartAction()
    {

        $current_date = date("Y-m-d");
        $user = Users::findFirst($this->session->get('auth')['id']);


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
                    $i_am_late = 0;

                }else{
                    $i_am_late = 1;
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
           'user_id' => $this->session->get('auth')['id'],
           'active' => 1,
           'i_am_late' => $i_am_late

       ]);
       if($time->save()){
           return $this->response->redirect('index/index');
       }
    }

    public function setendAction()
    {


        /* $date = new DateTime();
            $date->setTimezone(new DateTimeZone('UTC'));
            $date->setTimestamp(1297869844);
            $date->setTimezone(new DateTimeZone('Asia/Krasnoyarsk'));

            echo $date->format('d-m-y h:i:s');*/

        /*if($this->request->isGet()){

            $date = date('Y-m-d');
            $userAuth = $this->session->get('auth');
            $user = Users::findFirst($userAuth['id']);

            $result_time = '00:00:00';

            $time_start = '00:00:00';
            $time_end = '00:00:00';

            foreach ($user->getTimes() as $time){

               // print_die(date("H:i:s",$time->time_start));

                $time_start = date("H:i:s",$time->time_start);

                $time_end   = $time->time_end;

                print_die($time_start);

                if($time->current_date == $date){



                   // print_die($time->time_start);
                    $result_time += (date("H:i:s", $time->time_start) + date("H:i:s", $time->time_end));
                }

            }

            $date = '00:00:00';
            $currentDate = strtotime($date);
            $futureDate = $currentDate+($result_time);

            $formatDate = date("H:i:s", $futureDate);

           print_die($formatDate);

        }*/


     /* //  $th2 = strtotime(date('Y-m-d')."04:00");
      //  $th3 = strtotime(date('Y-m-d')."04:00");

       // print_die($th2);
       // print_r(date("h-i", $th2+$th3));

       $sesult = $tStart += 5;

        print_die(date('H:i:s', strtotime('+5 minutes', strtotime('08:29:49'))));
        print_die($tStart);

        //print_die(date("H:i:s ",strtotime("+".$time->time_start)));
     */

        $today = date("H:i",strtotime("+4 hour"));
        $user = Users::findFirst( $this->session->get('auth')['id']);
        $times = $user->getTimes();

        foreach ($times as $time){

           if($time->time_end == null && $time->active == 1){

               $time->time_end = $today;
               $time->active = 0;
               if($time->save()){
                   return $this->response->redirect('index/index');
               }

           }

        }

    }

}

