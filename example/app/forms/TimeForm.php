<?php

namespace Staff\Forms;


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;

class TimeForm extends Form
{
    public function initialize()
    {
        // Email
        $timeStart = new Text('text', [
            'placeholder' => 'Email',
            'name' => 'time_start[]'
        ]);
        $timeStart->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ])
        ]);
        $this->add($timeStart);


        $curr_date = new Hidden('current_date');

        $timeStart->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ])
        ]);
        $this->add($curr_date);

    }
}