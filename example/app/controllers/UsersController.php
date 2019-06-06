<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

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
       /* $this->session->set('user-name', 'Michael');
        print_die($this->session->get('user-name'));*/


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
            return;

        }

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


        $user = Users::findFirstByid($id);
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

        $this->flash->success("user was deleted successfully");

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

    public function authAction()
    {


        if ($this->request->isPost()) {

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirstByEmail($email);

            if ($user) {

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
            }else {
                //Пароль не верный или маил
                $this->flash->error('Неверный логин или пароль!');
                $this->dispatcher->forward([
                    'controller' => 'users',
                    'action'  => 'signIn'
                ]);
            }

        }
    }
    public function removeAuthAction()
    {

        $user = Users::findFirst($this->session->get('auth')['id']);
        $user->status = 0;

        if($user->save()){
            if($this->session->remove('auth')){
                $this->dispatcher->forward([
                    'controller' => 'index',
                    'action' => 'index'
                ]);
                return;
            }
            return $this->response->redirect('index');
        }
    }

}
