<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use Staff\Forms\ChangePassword;
use Staff\Forms\ChangePasswordForm;
use Staff\Forms\SignUpForm;
use Staff\Forms\SignInForm;
use Staff\Forms\SignUpUserForm;

use Staff\Controllers\ControllerBase;
use Staff\Services\UserService;
use Staff\Models\Users;


class UsersController extends ControllerBase
{

    public function initialize()
    {

    }

    /**
     * Index action
     */
    public function indexAction()
    {

    }

    /**
     * Searches for users
     */

    public function registerAction()
    {
        $user = new Users();

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $user->login = $login;

        // Сохраняем пароль хэшированным
        $user->password = $this->security->hash($password);

        $user->save();
    }


    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");

            $this->dispatcher->forward([
                "controller" => "users",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $users,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");

                $this->dispatcher->forward([
                    'controller' => "users",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("name", $user->name);
            $this->tag->setDefault("email", $user->email);
            
        }
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
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $user->name = $this->request->getPost("name");
        $user->email = $this->request->getPost("email", "email");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'edit',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => 'index'
        ]);
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


        /*$user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("user was deleted successfully");*/

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => "index"
        ]);
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


}
