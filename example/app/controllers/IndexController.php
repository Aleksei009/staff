<?php

use Prepare\Forms\UsersForm;

class IndexController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('main-public');
    }


    public function indexAction()
    {
        $form = new UsersForm();
        $this->view->form = $form;
    }

}

