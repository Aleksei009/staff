<?php

namespace Prepare\Controllers;

class PostsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function showAction($postId)
    {
        // Pass the $postId parameter to the view
        $this->view->postId = $postId;
    }

}

