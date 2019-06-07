<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Controller;

use Staff\Helpers\Day;
use Staff\Services\UserService;
use Staff\Services\TimeService;

class ControllerBase extends Controller
{

    protected $auth;
    protected $day;
    protected $userService;
    protected $timeService;

    public function initialize(){

        if($this->session->has('auth')){
            $this->auth = $this->session->get('auth');
        }else{
            $this->auth = false;
        }

        $this->day = new Day();
        $this->userService = new UserService();
        $this->timeService = new TimeService();

    }
}
