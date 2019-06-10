<?php


namespace Staff\Library\Acl;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


class MyAcl
{

   /* public $private;

    public function initialize()
    {
        $this->private = new AclList();
    }

    public function acl($privateRole)
    {
       // $aclPrivateRole = $this->AclResources;

        //$acl = new AclList();

        $this->private->setDefaultAction(
            Acl::DENY
        );

        $roleAdmins = new Role('admin');
        $roleUser = new Role('user');

        $this->private->addRole($roleAdmins);
        $this->private->addRole($roleUser);

        $usersResource      = new Resource('Users');
        $indexResource      = new Resource('Index');
        $sessionResource    = new Resource('Session');

        $this->private->addResource(
            $usersResource,[
                'index',
                'create',
                'search'
            ]
        );
        $this->private->addResource(
            $indexResource,[
                'index',
                'setstart',
                'setend'
            ]
        );
        $this->private->addResource(
            $sessionResource,[
                'index',
            ]
        );

        foreach ($privateRole as $privateControllers){

            foreach ($privateControllers as $K=>$controller){
                foreach ($controller as $action){
                    $this->private->allow('admin', $K, $action);
                    // print_die($acl);
                }
            }

        }


        // print_die($acl);

        $this->private->allow('admin', 'Users', 'create');

       return $this;
    }*/

}