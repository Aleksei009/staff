<?php

namespace Staff\Forms;


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class HolidayForm extends Form
{
    public function initialize()
    {
        // Title
        $name = new Text('name', [
            'placeholder' => 'Название праздника'
        ]);

        $name->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ])
        ]);
        $this->add($name);

        $date = new Date('date',[
            'placeholder' => '00:00:00'
        ]);

        $date->addValidators([

            new PresenceOf([
                'message' => 'The e-mail is required'
            ])
        ]);
        $this->add($date);

        // Remember
        $everyYear = new Check('everyYear', [
            'value' => 1
        ]);
        $everyYear->setLabel('Remember me');
        $this->add($everyYear);

        $this->add(new Submit('go', [
            'class' => 'btn btn-success',
            'value' => 'Сохранить'
        ]));
    }
}