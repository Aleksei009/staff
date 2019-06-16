<?php

namespace Staff\Services;

use Staff\Services\MainService;

use Staff\Models\Users;

class UserService extends MainService
{

    /**
     * @param $data
     * @return Users
     * @throws \Exception
     */
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

    public function getTimesForUser($auth)
    {
        $user = Users::findFirst($auth['id']);
        $userTime = $user->getTimes()->toArray();
        return $userTime;
    }

    public function getAllUsersByIdDesc(){

        $users = Users::find([
            'order' => 'id DESC'
        ]);

        return $users;
    }

    public function sortUsers($userAuth)
    {
        $user = Users::findFirst($userAuth['id'])->toArray();
        $users = Users::find([
            'conditions' => 'deleted = :deleted:',
            'bind' => [
                'deleted' => 0
            ]
        ])->toArray();
        foreach ($users as $k=>$item) {

            if($user['id'] == $item['id']){
                unset($users[$k]);
            }

        }

        array_unshift($users, $user);

        return $users;
    }


}