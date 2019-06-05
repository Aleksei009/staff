<?php

namespace Staff\Controllers;

use Staff\Forms\LoginForm;
use Staff\Forms\SignUpForm;
use Staff\Auth\Exception as AuthException;
use Staff\Forms\SignUpUserForm;
use Staff\Models\Users;

use Staff\Services\UserService;
/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 */
class SessionController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }
    public function indexAction()
    {
    }
    /**
     * Allow a user to signup to the system
     */
    public function signupAction()
    {

       /* if($this->request->isPost()){
            return $this->dispatcher->forward([
               'controller' => 'index',
               'action'  => 'index'
            ]);
        }*/
       /* $form = new SignUpForm();
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'profilesId' => 2
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
        $this->view->form = $form;*/

     /*  $form = new SignUpUserForm();
       $data = $this->request->get();
       $data['password'] = $this->security->hash( $data['password']);*/

      // print_die($this->request->getPost());

       /* if(!$form->isValid($_POST)){

            return $this->dispatcher->forward(
                [
                    'action' => 'index',
                ]
            );
        }*/


          // print_die(!$form->isValid($this->request->getPost()));

           /*$userService = new UserService();
           $data = $this->request->get();
            if($this->request->siPost()){
                try{
                    $userService->registerUser($data);

                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);

                }catch (\Exception $e){

                    $this->flashSession->error('Пользователь с такими данными уже существует!');

                    $this->response->redirect('index');
                    return;
                }
            }*/

        $form = new SignUpUserForm();

        if(!$form->isValid($_POST)){

            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index',
                ]
            );
        }else{
            $data = $this->request->get();
            $data['password'] = $this->security->hash( $data['password']);

            $userService = new UserService();

            try {
                $userService->registerUser($data);

                if($userService){
                   // $this->flash->success('Пользователь успешно создан!');
                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
            } catch (\Exception $e) {

                $this->flashSession->error('Пользователь с такими данными уже существует!');

               return $this->response->redirect('index/index');

               /* return   $this->dispatcher->forward([
                    'controller' => "index",
                    'action' => 'index'
                ]);*/


            }
        }

       //$this->view->form = $form;
    }
    /**
     * Starts a session in the admin backend
     */
    /*public function loginAction()
    {
        $form = new LoginForm();
        try {
            if (!$this->request->isPost()) {
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->auth->check([
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ]);
                    return $this->response->redirect('users');
                }
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->form = $form;
    }*/
    public function loginAction()
    {
        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $user = Users::findFirstByLogin($login);

        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                
            }
        } else {

            $this->security->hash(rand());
        }

    }
    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        return $this->response->redirect('index');
    }
}

