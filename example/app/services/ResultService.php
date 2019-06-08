<?php


namespace Staff\Services;


use Staff\Services\MainService;

use Staff\Models\Results;

class ResultService extends MainService
{

    public function getAllResults()
    {
        $results = Results::find()->toArray();
        return $results;
    }
    public function getOneAuthResult($auth)
    {
        $result = Results::findFirst($auth['id']);
        return $result;
    }

    public function getAllAuthResult($auth)
    {
        $result = Results::find([
            'conditions' => 'user_id= :user_id:',
            'bind' => [
                'user_id' => $auth['id']
            ]
        ]);

        return $result;
    }

    public function saveAndUpdateCurrentResultTime($array,$auth)
    {
        if($this->authCurrentDateResult($auth)){
           return $this->updateResult($array,$auth);
        }else{
          return $this->saveResult($array);
        }
    }

    public function authCurrentDateResult($auth)
    {
        $result = Results::findFirst([
            'conditions' => 'date = :date: AND user_id = :user_id:',
            'bind' => [
                'date' => date('Y-m-d'),
                'user_id' => $auth['id']
            ]
        ]);

        return $result;
    }

    public function updateResult($array,$auth = null)
    {
        $result  = Results::findFirst([
            'conditions' => 'date = :date: AND user_id = :user_id:',
            'bind' => [
                'date' => $array['date'],
                'user_id' => $auth['id']
            ]
        ]);

        if($result){
           return $result->save($array);
        }
    }

    public function saveResult($array)
    {
        $result = new Results();
        return $result->save($array);
    }



}