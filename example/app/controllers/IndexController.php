<?php

use Prepare\Forms\UsersForm;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Prepare\Roles\UserRole;
use Prepare\Roles\ModelResource;

use Prepare\Forms\SignUpForm;


class IndexController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('main-public');
    }


    public function indexAction()
    {

        $users = Users::find();

        $data = null;


        //print_die($data);

        /*$acl = new AclList();
        $acl->setDefaultAction(
                Acl::DENY
        );

        $roleAdmins = new Role('Administrators', 'Super-User role');
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


         //$form = new UsersForm();
        $form = new SignUpForm();
        $this->view->form = $form;


    }

}

