<?php

namespace Staff\Controllers;

use Staff\Forms\LoginForm;
use Staff\Forms\SignInForm;
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

    }
    public function indexAction()
    {
    }

    public function signInAction()
    {
        $form = new SignInForm();
        $this->view->form = $form;

    }

    public function authAction()
    {
        if ($this->request->isPost()) {

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirstByEmail($email);

            if ($user) {

                if ($user->deleted == 0){
                    if ($this->security->checkHash($password, $user->password)) {

                        // Пароль верный

                        if($user->role == 'admin'){

                            $this->session->set('auth',[
                                'id'   => $user->id,
                                'role' => $user->role,
                                'name' => $user->name,
                                'user' => $user->email,
                                'csrf' => $this->request->get('csrf')
                            ]);
                        }

                        if($user->role == 'user'){

                            $this->session->set('auth',[
                                'id' => $user->id,
                                'role' =>  $user->role,
                                'name' =>  $user->name,
                                'email' => $user->email,
                                'csrf' => $this->request->get('csrf')
                            ]);
                        }
                        $user->status = 1;
                        $user->save();
                        $this->response->redirect('index');
                    }
                }else{

                    $this->flash->error('Неверный логин или пароль!');
                    return  $this->dispatcher->forward([
                        'controller' => 'session',
                        'action'  => 'signIn'
                    ]);

                }

            }else {
                //Пароль не верный или маил
                $this->flash->error('Неверный логин или пароль!');
                return  $this->dispatcher->forward([
                    'controller' => 'session',
                    'action'  => 'signIn'
                ]);
            }

            $this->flash->error('Неверный логин или пароль!');
            return  $this->dispatcher->forward([
                'controller' => 'session',
                'action'  => 'signIn'
            ]);

        }
    }

    /**
     * Closes the session
     */
    public function removeAuthAction()
    {
        $user = Users::findFirst($this->session->get('auth')['id']);
        $user->status = 0;

        if($user->save()){
            if($this->session->remove('auth')){
                return $this->response->redirect('index');

            }
            return $this->response->redirect('index');
        }
    }


}

