<?php

namespace Staff\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;


class SignInForm extends Form
{

    public function initialize()
    {

        $email = new Text('email',[
            'placeholder' => 'email',
            'class' => 'form-control'
        ]);

        $email->addValidators([
           new PresenceOf([
              'message' => 'Yor email is required'
           ]),
            new Email([
                'message' => 'this email is not correct'
            ])
        ]);

        $this->add($email);

        $password = new Password('password',[
            'placeholder' => 'password',
            'class' => 'form-control'
        ]);

        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ])
        ]);

        $this->add($password);

        // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        ]));
        $csrf->clear();
        $this->add($csrf);

        $this->add(new Submit('go',[
            'class' => 'btn btn-success'
        ]));
    }

}