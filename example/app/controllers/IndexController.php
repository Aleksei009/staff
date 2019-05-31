<?php

use Prepare\Controllers\ControllerBase;

class IndexController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('main-public');
    }


    public function indexAction()
    {

    }

}

