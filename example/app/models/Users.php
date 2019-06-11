<?php

namespace Staff\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model;

class Users extends Model
{

    const ROLE_USER_ADMIN = 'admin';
    const ROLE_USER_GUEST = 'user';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $role;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("staff");
        $this->setSource("users");


        $this->hasMany('id', 'Staff\Models\Times', 'user_id', [
            'alias' => 'times',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);

        $this->hasMany('id','Staff\Models\Results','user_id',[
            'alias' => 'results',
            'foreignKey' => [
                'message'=> 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);

        $this->hasMany('id','Staff\Models\Permissions','user_id',[
            'alias' => 'permissions',
            'foreignKey' => [
                'message'=> 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);


    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function registerAdmin($data)
    {
        $this->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'  => $data['password'],
            'role' => self::ROLE_USER_ADMIN
        ]);

        return $this;

    }

    public function registerGuest($data)
    {
        $this->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'  => $data['password'],
            'role' => self::ROLE_USER_GUEST
        ]);
        return $this;
    }

    public function checkArticles()
    {


    }

    public function getRoles()
    {
        return [

          1 => self::ROLE_USER_ADMIN,
          2 => self::ROLE_USER_GUEST

        ];
    }



}
