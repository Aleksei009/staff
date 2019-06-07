<?php

namespace Staff\Services;

use http\Client\Curl\User;
use Staff\Services\MainService;

use Staff\Models\Users;

class UserService extends MainService
{

    public function registerUser($data)
    {
        $users = Users::find();
        $user = new Users();

        //$data['password'] = $this->security->hash( $data['password']);

        if(count($users) >= 1){
            $user = $user->registerGuest($data);
        }else{
            $user = $user->registerAdmin($data);
        }

        if (!$user){

            throw new \Exception("Пользователь с такими данными уже зарегистрирован в системе");

        }else{

            return $user;
        }
    }

    public function allUsers()
    {
        $users = Users::find();
        return $users;
    }

    public function getTimesForUser($id)
    {
        $user = Users::findFirst($id);
        $userTime = $user->getTimes();
        return $userTime;
    }

    public function getAllUsersByIdDesc(){

        $users = Users::find([
            'order' => 'id DESC'
        ]);

        return $users;
    }


}