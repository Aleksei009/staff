<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;

use  Staff\Library\Acl\MyAcl;

use Staff\Helpers\Day;
use Staff\Services\LatesService;
use Staff\Services\ResultService;
use Staff\Services\UserService;
use Staff\Services\TimeService;

class ControllerBase extends Controller
{

    protected $auth;
    protected $day;
    protected $userService;
    protected $timeService;
    protected $resultService;
    protected $aclPrivate;
    protected $latesService;

    public function initialize(){

        if($this->session->has('auth')){
            $this->auth = $this->session->get('auth');
        }else{
            $this->auth = false;
        }

        $this->day = new Day();
        $this->userService = new UserService();
        $this->timeService = new TimeService();
        $this->resultService = new ResultService();
        $this->aclPrivate = new MyAcl();
        $this->latesService = new LatesService();

    }

    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
   /* public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();
        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {
            // Get the current identity
            $identity = $this->auth;
            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {
               // $this->flash->notice('You don\'t have access to this module: private');
                $dispatcher->forward([
                    'controller' => 'users',
                    'action' => 'signIn'
                ]);
                return false;
            }

            // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            if (!$this->acl->isAllowed($identity['role'], $controllerName, $actionName)) {
                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);
                if ($this->acl->isAllowed($identity['role'], $controllerName, 'index')) {
                    $dispatcher->forward([
                        'controller' => $controllerName,
                        'action' => 'index'
                    ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
                return false;
            }
        }
    }*/

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {



      /* $aclPrivate = $this->aclPrivate;

       //print_die($this->resultService);

        $aclPrivateRole = $this->AclResources;

        $acl = new AclList();

        $acl->setDefaultAction(
            Acl::DENY
        );

        $roleAdmins = new Role('admin');
        $roleUser = new Role('user');

        $acl->addRole($roleAdmins);
        $acl->addRole($roleUser);

        $usersResource      = new Resource('Users');
        $indexResource      = new Resource('Index');
        $sessionResource    = new Resource('Session');

        $acl->addResource(
            $usersResource,[
                'index',
                'create',
                'search'
            ]
        );
        $acl->addResource(
            $indexResource,[
                'index',
                'setstart',
                'setend'
            ]
        );
        $acl->addResource(
            $sessionResource,[
                'index',
            ]
        );

        foreach ($aclPrivateRole as $privateControllers){

            foreach ($privateControllers as $K=>$controller){
                foreach ($controller as $action){
                    $acl->allow('admin', $K, $action);
                   // print_die($acl);
                }
            }

        }



      // print_die($acl);

        $acl->allow('admin', 'Users', 'create');

        //print_die($acl->isAllowed('admin', 'Index', 'setstart'));*/


       // print_die($acl);
    }
}
