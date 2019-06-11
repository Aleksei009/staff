<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Helpers\Day;
use Staff\Models\Permissions;
use Staff\Models\Profiles;
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
        $this->latesService = new LatesService();
    }

    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
      // print_die($this->auth['role']);
       // print_die($this->auth['role']);
        //$controllerName = $dispatcher->getControllerName();
       // $actionName = $dispatcher->getActionName();

       // print_die($this->acl->getPermissions(Profiles::findFirst()));
        // print_die($this->acl->isAllowed('admin', 'users', 'changePassword'));

        $controllerName = $dispatcher->getControllerName();
        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {
            // Get the current identity
            $identity = $this->session->get('auth');
            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {
                $this->flash->notice('You don\'t have access to this module: private');
                $dispatcher->forward([
                    'controller' => 'index',
                    'action' => 'index'
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
                        'controller' => 'user_control',
                        'action' => 'index'
                    ]);
                }
                return false;
            }
        }
    }
}
