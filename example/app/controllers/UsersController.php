<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use Staff\Forms\ChangePassword;
use Staff\Forms\ChangePasswordForm;
use Staff\Forms\HolidayForm;
use Staff\Forms\SignUpForm;
use Staff\Forms\SignInForm;
use Staff\Forms\SignUpUserForm;

use Staff\Forms\TimeForm;
use Staff\Models\Holidays;
use Staff\Models\Lates;
use Staff\Models\Times;
use Staff\Services\UserService;
use Staff\Models\Users;


class UsersController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction()
    {

    }

    /**
     * Creates a new user
     */
    public function createAction()
    {

        $form = new SignUpUserForm();

        if(!$form->isValid($_POST)){

            return $this->dispatcher->forward(
                [
                    'action' => 'signUp',
                ]
            );
        }

        $data = $this->request->get();
        $data['password'] = $this->security->hash( $data['password']);

        $userService = new UserService();

        try {
            $userService->registerUser($data);
        } catch (\Exception $e) {

            $this->flashSession->error('Пользователь с такими данными уже существует!');

            $this->response->redirect('users/signUp');

        }

       return $this->response->redirect('index/index');

    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirst($id);
        $user->deleted = 1;

        if($user->save()){

            $this->flash->success('все ок');
            $this->response->redirect('users/table');
        }else{

            $this->flash->error('все плохо');

           $this->response->redirect('users/table');
        }

    }
    public function returnAction($id)
    {
        $user = Users::findFirst($id);
        $user->deleted = 0;

        if($user->save()){

            $this->flash->success('все ок');
            $this->response->redirect('users/table');
        }else{

            $this->flash->error('все плохо');

            $this->response->redirect('users/table');
        }

    }


    public function signInAction()
    {

        $form = new SignInForm();
        $this->view->form = $form;

    }

    public function signUpAction()
    {

        $form = new SignUpUserForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password'))
                ]);
                if ($user->save()) {
                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
                $this->flash->error($user->getMessages());
            }
        }
        $this->view->form = $form;

    }


    public function changePasswordAction()
    {
        $form = new ChangePasswordForm();

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                //$user = $this->auth;
                $user = Users::findFirst($this->auth['id']);
                $user->password = $this->security->hash($this->request->getPost('password'));

                if (!$user->save()) {
                    $this->flash->error('Данный пароль не был сохранен');
                } else {
                    $this->flash->success('Your password was successfully changed');
                }
            }
        }

        $this->view->form = $form;

    }
    public function tableAction()
    {
        $users = Users::find();
        $this->view->users = $users;
    }

    public function correctAction($id)
    {

        $user = Users::findFirst($id);
        $curTimeForUser = $user->getTimes([
            'order' => 'current_date DESC',
        ]);


        if($curTimeForUser->toArray() == []){
            $curTimeForUser = [];
        }

        $this->view->user = $user;
        $this->view->times = $curTimeForUser;



        if($this->request->isPost()){

            $data = $this->request->get();
            $dataForm = $this->request->getPost();

          //  print_die($data);

            $timeUpdate = Times::findFirst([
               'conditions' => 'id = :id:',
                'bind' => [
                    'id' => $dataForm['id'],
                ]
            ]);

            $timeUpdate->time_start = $dataForm['time_start'];
            $timeUpdate->time_end = $dataForm['time_end'];
            $timeUpdate->current_date = $dataForm['current_date'];

            if($timeUpdate->save()){

                $resultTimeUser = $this->day->resultTime($this->auth);
                $current_date = date('Y-m-d');
                $this->resultService->saveAndUpdateCurrentResultTime([
                    'date' => $current_date,
                    'result_time' => $resultTimeUser,
                    'user_id' => $this->auth['id']
                ],$this->auth);


                $this->flash->success('Данные изменены');
                $this->dispatcher->forward([
                    'controller' => 'users',
                    'action'  => 'time'
                ]);
            }else{
                $this->flash->error('Данные не изменены');
                $this->dispatcher->forward([
                    'controller' => 'users',
                    'action'  => 'time'
                ]);
            }

            if ($data['corDay']){
                if ($data['corDay'] == 'on'){
                    $bool = $this->day->correctDay($data['user_id']);

                    if($bool){

                      $lateUser =  Lates::findFirst([
                            'conditions' => 'user_id = :user_id:',
                            'bind' => [
                                'user_id' => $data['user_id']
                            ]
                        ]);

                        if($lateUser){
                            $lateUser->count_lates -= 1;
                            $lateUser->save();
                        }

                        $this->flash->success('Пользователь пришел вовремя');
                        return  $this->dispatcher->forward([
                            'controller' => 'users',
                            'action'  => 'table'
                        ]);
                    }else{

                        $this->flash->error('Данные не изменены или Данных нет');
                        return  $this->dispatcher->forward([
                            'controller' => 'users',
                            'action'  => 'table',
                            'id' => $user->id
                        ]);
                    }

                }else{

                    return  $this->dispatcher->forward([
                        'controller' => 'users',
                        'action'  => 'table'
                    ]);
                }
            }


        }

    }
    public function testAction(){
        var_dump(213456789);
    }


    public function timeAction($id)
    {
        $time = Times::findFirst($id);
        $form =  new TimeForm($time);

        $this->view->form = $form;
        $this->view->id = $time->user_id;

        $timeR = Times::findFirst([
            'conditions' => 'current_date = :current_date: AND i_am_late = :i_am_late: AND user_id= :user_id:',
            'bind' => [
                'current_date' => (date('Y-m-d')),
                'i_am_late' => 1,
                'user_id' => $time->user_id
            ]
        ]);

        if($timeR){
            $this->view->time = $timeR->toArray();
        }else{
            $this->view->time = [];
        }

    }

    public function holidayAction()
    {
       //print_die($this->request->get());

        $form = new HolidayForm();

        if ($this->request->isPost()) {

            if (!$form->isValid($this->request->getPost())) {

                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }

            } else{

                $data = $this->request->getPost();

                $holiday = new Holidays($data);

                if (!$holiday->save()) {
                    $this->flash->error('Данные не сохранены');

                } else {
                    $this->flash->success('Your password was successfully changed');

                   $this->response->redirect('index/index');
                }
             }

        }

        $this->view->form = $form;

    }



}
